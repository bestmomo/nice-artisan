<?php

namespace Bestmomo\NiceArtisan\Http\Controllers;

use Bestmomo\NiceArtisan\CommandDocumentationLoader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Bestmomo\NiceArtisan\JsonListManager;
use Symfony\Component\Console\Output\BufferedOutput;
use Throwable;

class NiceArtisanController
{
    private const COMMAND_OPTIONS = [
        "favorites", "cache", "config", "db", "env", "event",
        "make", "migrate", "optimize", "queue","route",
        "schedule", "model", "view", "storage", "misc",
    ];

    private const GLOBAL_OPTIONS = [
        ['name' => 'v', 'description' => 'Increase the verbosity of messages (normal output)', 'type' => 'checkbox'],
        ['name' => 'vv', 'description' => 'Increase the verbosity of messages (more verbose output)', 'type' => 'checkbox'],
        ['name' => 'vvv', 'description' => 'Increase the verbosity of messages (debug)', 'type' => 'checkbox'],
        ['name' => 'help', 'description' => 'Display help for the given command', 'type' => 'checkbox'],
        ['name' => 'env', 'description' => 'The environment the command should run under', 'type' => 'text'],
    ];

    /**
     * Display Artisan commands with filtering and favorites support.
     *
     * This method retrieves all available Artisan commands, applies filtering based on
     * search terms or command categories, and displays them in a web interface.
     * It also handles temporary command results and manages favorite commands.
     *
     * @param Request $request The HTTP request containing search and filter parameters
     * @param JsonListManager $jsonListManager Service for managing favorite commands
     * @param CommandDocumentationLoader $docsLoader Service for managing documentation commands
     * @param string|null $option Optional category filter for commands (e.g., 'migrate', 'cache')
     * @return View Returns a view with filtered commands, options, and command results
     */
    public function show(Request $request, JsonListManager $jsonListManager, CommandDocumentationLoader $docsLoader, $option = null): View
    {
        $commandResult = null;
        if (Storage::disk('local')->exists('niceartisan/temp.json')) {
            $content = Storage::disk('local')->get('niceartisan/temp.json');
            $fileData = json_decode($content, true);

            if (isset($fileData['timestamp'])) {
                $fileTime = Carbon::parse($fileData['timestamp']);
                $now = now();

                if ($fileTime->diffInSeconds($now) <= 10) {
                    $commandResult = $fileData;
                }
            }

            Storage::disk('local')->delete('niceartisan/temp.json');
        }

        $options = self::COMMAND_OPTIONS;
        $globalOptions = self::GLOBAL_OPTIONS;

        $allCommands = collect(Artisan::all());

        $favorites = collect($jsonListManager->getList());

        $allCommands = $allCommands->map(function ($command) use ($favorites, $docsLoader) {
            $isFavorite = $favorites->contains($command->getName());
            $hasDoc = $docsLoader->get($command->getName()) !== null;

            $command->favorite = $isFavorite;
            $command->doc = $hasDoc;
            return $command;
        });

        $search = $request->input('search');
        if ($search) {
            $items = $allCommands->filter(function ($command, $key) use ($search) {
                return Str::contains($key, $search);
            })->all();

            ksort($items);

            return view('NiceArtisan::index', compact('items', 'options', 'commandResult', 'globalOptions'));
        }

        if (!in_array($option, $options, true)) {
            $option = self::COMMAND_OPTIONS[0];
        }

        $allPrefixes = collect($options)->diff(['misc', 'favorites']);

        if ($option == 'misc') {
            $items = $allCommands->filter(function ($command) use ($allPrefixes) {
                if (!str_contains($command->getName(), ':')) {
                    return !$allPrefixes->contains($command->getName());
                }
                $commandPrefix = explode(':', $command->getName())[0];
                return !$allPrefixes->contains($commandPrefix);
            })->all();
        } elseif ($option == 'favorites') {
            $items = $allCommands->filter(function ($command) {
                return $command->favorite;
            })->all();
        } else {
            $items = $allCommands->filter(function ($command) use ($option) {
                return str_starts_with($command->getName(), $option . ':') || $command->getName() === $option;
            })->all();
        }

        ksort($items);

        return view('NiceArtisan::index', compact('items', 'options', 'commandResult', 'globalOptions'));
    }

    /**
     * Execute an Artisan command with parameter handling and error management.
     *
     * This method processes HTTP requests to execute Artisan commands, handling command
     * parameters, validating blocked commands, and storing results temporarily.
     * It provides a web interface for running Laravel Artisan commands safely.
     *
     * @param Request $request The HTTP request containing command and parameters
     * @param string $command The name of the Artisan command to execute
     * @return RedirectResponse Redirects back with command execution results
     */
    public function command(Request $request, string $command): RedirectResponse
    {
        if (!$request->filled('option_help')) {
            if (array_key_exists('argument_name', $request->all())) {
                $request->validate(['argument_name' => 'required']);
            }

            if (array_key_exists('argument_id', $request->all())) {
                $request->validate(['argument_id' => 'required']);
            }
        }

        $inputs = $request->except('_token', 'command');
        $params = [];

        $shortGlobalOptionNames = collect(self::GLOBAL_OPTIONS)
            ->filter(fn($opt) => strlen($opt['name']) === 1)
            ->pluck('name')
            ->toArray();

        foreach ($inputs as $key => $value) {
            if ($value !== '') {
                if (Str::startsWith($key, 'argument_')) {
                    $name = substr($key, 9);
                } else {
                    $optionName = substr($key, 7);
                    $isShortOption = false;
                    foreach ($shortGlobalOptionNames as $shortName) {
                        if (Str::startsWith($optionName, $shortName)) {
                            $isShortOption = true;
                            break;
                        }
                    }
                    if ($isShortOption) {
                        $name = '-' . $optionName;
                    } else {
                        $name = '--' . $optionName;
                    }
                }
                $params[$name] = $value;
            }
        }

        $blockedCommands = [
            'docs' => 'This command opens documentation in a browser and blocks execution.',
            'serve' => 'This command starts a web server and blocks execution.',
            'tinker' => 'This is an interactive REPL and cannot run in web interface.',
            'install:api' => 'This command modifies application structure and requires terminal.',
            'install:broadcasting' => 'This command modifies application structure and requires terminal.',
            'vendor:publish' => 'This command may require user interaction.',
        ];

        if (array_key_exists($command, $blockedCommands)) {
            $data = [
                'type' => 'error',
                'error' => $blockedCommands[$command],
                'command' => $command,
                'timestamp' => now()->format('H:i:s')
            ];

            Storage::disk('local')->put('niceartisan/temp.json', json_encode($data));
            return back();
        }

        try {
            $output = new BufferedOutput();
            Artisan::call($command, $params, $output);
            $outputContent = $output->fetch();

            $data = [
                'type' => 'success',
                'output' => $outputContent,
                'command' => $command,
                'timestamp' => now()->format('H:i:s')
            ];

            Storage::disk('local')->put('niceartisan/temp.json', json_encode($data));
            return back();

        } catch (Throwable $e) {
            $errorMessage = $this->getUserFriendlyError($e, $command);

            $data = [
                'type' => 'error',
                'error' => $errorMessage,
                'command' => $command,
                'timestamp' => now()->format('H:i:s')
            ];

            Storage::disk('local')->put('niceartisan/temp.json', json_encode($data));
            return back();
        }
    }

    /**
     * Convert technical error messages to user-friendly messages for Artisan commands.
     *
     * This method takes a Throwable exception and converts common technical error patterns
     * that occur when running Artisan commands in a web interface into more understandable
     * messages for end users.
     *
     * @param Throwable $e The exception that occurred during command execution
     * @param string $command The name of the Artisan command that failed
     * @return string A user-friendly error message
     */
    protected function getUserFriendlyError(Throwable $e, string $command): string
    {
        $message = $e->getMessage();

        $patterns = [
            'Undefined constant STDIN' => "Command '$command' requires terminal input which is not available in web interface.",
            'STDIN' => "Command '$command' cannot access terminal input in web environment.",
            'interactive' => "Command '$command' is interactive and requires user input.",
            'InputInterface' => "Command '$command' requires console input interface.",
        ];

        foreach ($patterns as $pattern => $friendlyMessage) {
            if (str_contains($message, $pattern)) {
                return $friendlyMessage;
            }
        }

        return $message;
    }

    /**
     * Add a command to the favorites list.
     *
     * @param Request $request The HTTP request containing the command name to add
     * @param JsonListManager $jsonListManager Service for managing favorite commands
     * @return JsonResponse JSON response indicating success
     */
    public function addFav(Request $request, JsonListManager $jsonListManager): JsonResponse
    {
        $jsonListManager->addElement($request->item);

        return response()->json();
    }

    /**
     * Remove a command from the favorites list.
     *
     * @param Request $request The HTTP request containing the command name to remove
     * @param JsonListManager $jsonListManager Service for managing favorite commands
     * @return JsonResponse JSON response indicating success
     */
    public function removeFav(Request $request, JsonListManager $jsonListManager): JsonResponse
    {
        $jsonListManager->removeElement($request->item);

        return response()->json();
    }

    /**
     * Get the documentation for a command.
     *
     * @param string $command The name of the Artisan command
     * @param CommandDocumentationLoader $commandDocumentationLoader Service for managing commands documentation
     * @return JsonResponse JSON response indicating success
     */
    public function showCommandDocs(string $command, CommandDocumentationLoader $docsLoader): JsonResponse
    {
        $documentation = $docsLoader->get($command);

        if (!$documentation) {
            return response()->json([
                'error' => 'Documentation not found'
            ], 404);
        }

        // Retourner en JSON pour AJAX
        return response()->json([
            'command' => $command,
            'html' => $documentation['html'],
            'metadata' => $documentation['metadata']
        ]);
    }
}
