<?php

namespace Bestmomo\NiceArtisan\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Bestmomo\NiceArtisan\JsonListManager;

class NiceArtisanController
{
    private const COMMAND_OPTIONS = [
        "favorites", "cache", "config", "db", "env", "event",
        "install", "make", "migrate", "optimize", "queue",
        "route", "schedule", "model", "view", "storage", "misc",
    ];

    /**
     * Show the commands.
     *
     * @return Response
     */
    public function show(Request $request, JsonListManager $jsonListManager, $option = null): View
    {
        $options = self::COMMAND_OPTIONS;

        $allCommands = collect(Artisan::all());

        $favorites = collect($jsonListManager->getList());

        $allCommands = $allCommands->map(function ($command) use ($favorites) {
            $isFavorite = $favorites->contains($command->getName());
            $command->favorite = $isFavorite;
            return $command;
        }); 

        $search = $request->input('search');
        if ($search) {
            $items = $allCommands->filter(function ($command, $key) use ($search) {
                return Str::contains($key, $search);
            })->all();

            ksort($items);

            return view('NiceArtisan::index', compact('items', 'options'));
        }

        if (!in_array($option, $options, true)) {
            $option = self::COMMAND_OPTIONS[0];
        }

        $items = [];
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

        return view('NiceArtisan::index', compact('items', 'options'));
    }

    /**
     * Call the Artisan  command
     *
     * @param  Request  $request
     * @param  string $command
     */
    public function command(Request $request, $command): RedirectResponse
    {
        if (array_key_exists('argument_name', $request->all())) {
            $request->validate(['argument_name' => 'required']);
        }

        if (array_key_exists('argument_id', $request->all())) {
            $request->validate(['argument_id' => 'required']);
        }

        $inputs = $request->except('_token', 'command');

        $params = [];
        foreach ($inputs as $key => $value) {
            if ($value != '') {
                $name = Str::startsWith($key, 'argument') ? substr($key, 9) : '--' . substr($key, 7);
                $params[$name] = $value;
            }
        }

        try {
            Artisan::call($command, $params);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('output', Artisan::output())->with('status', 'success');
    }

    /**
     * Set a favorite
     */
    public function addFav(Request $request, JsonListManager $jsonListManager): JsonResponse
    {
        $jsonListManager->addElement($request->item);

        return response()->json();
    }

    /**
     * Remove a favorite
     */
    public function removeFav(Request $request, JsonListManager $jsonListManager): JsonResponse
    {
        $jsonListManager->removeElement($request->item);

        return response()->json();
    }
}
