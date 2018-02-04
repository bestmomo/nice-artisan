<?php

namespace Bestmomo\NiceArtisan\Http\Controllers;

use Bestmomo\NiceArtisan\Http\Kernel;
use AppController;
use Artisan;
use Exception;
use Illuminate\Http\Request;

class NiceArtisanController extends AppController
{
    /**
     * All core commands.
     *
     */
    protected $coreCommands = [
        'make:auth',
        'help',
        'list',
        'app:name',
        'clear-compiled',
        'make:command',
        'config:cache',
        'config:clear',
        'make:console',
        'event:generate',
        'make:event',
        'down',
        'env',
        'handler:command',
        'handler:event',
        'make:job',
        'key:generate',
        'make:listener',
        'make:model',
        'optimize',
        'make:policy',
        'make:provider',
        'make:request',
        'route:cache',
        'route:clear',
        'route:list',
        'serve',
        'make:test',
        'tinker',
        'up',
        'vendor:publish',
        'view:clear',
        'cache:clear',
        'cache:table',
        'cache:forget',
        'schedule:run',
        'schedule:finish',
        'migrate',
        'make:migration',
        'migrate:fresh',
        'migrate:install',
        'migrate:rollback',
        'migrate:reset',
        'migrate:refresh',
        'migrate:status',
        'db:seed',
        'make:seeder',
        'queue:table',
        'queue:failed',
        'queue:retry',
        'queue:forget',
        'queue:flush',
        'queue:failed-table',
        'make:controller',
        'make:middleware',
        'session:table',
        'queue:work',
        'queue:restart',
        'queue:listen',
        'queue:subscribe',
        'auth:clear-resets',
        'storage:link',
        'make:mail',
        'make:notification',
        'notifications:table',
        'make:factory',
        'make:resource',
        'make:rule',
        'preset',
        'package:discover',
        'make:exception',
    ];

    /**
     * Create a new NiceArtisanController controller instance.
     *
     * @return void
     */
    public function __construct(Kernel $kernel)
    {
        if ($kernel->hasRouteMiddleware('nice_artisan')) {
            $this->middleware('nice_artisan');
        }
    }

    /**
     * Show the commands.
     *
     * @return Response
     */
    public function show($option = null)
    {
        $options = array_keys(config('commands.commands'));
        array_push($options, 'customs');

        if (is_null($option)) {
            $option = array_values($options)[0];
        }

        if (!in_array($option, $options)) {
            abort(404);
        }

        if ($option == 'customs') {
            $items = array_diff_key(Artisan::all(), array_flip($this->coreCommands));
        } else {
            $items = array_intersect_key(Artisan::all(), array_flip(config('commands.commands.' . $option)));
        }

        return view('NiceArtisan::index', compact('items', 'options'));
    }

    /**
     * Call the Artisan  command
     *
     * @param  Request  $request
     * @param  string $command
     */
    public function command(Request $request, $command)
    {
        if (array_key_exists('argument_name', $request->all())) {
            $this->validate($request, ['argument_name' => 'required']);
        }

        if (array_key_exists('argument_id', $request->all())) {
            $this->validate($request, ['argument_id' => 'required']);
        }

        $inputs = $request->except('_token', 'command');

        $params = [];
        foreach ($inputs as $key => $value) {
            if ($value != '') {
                $name = starts_with($key, 'argument') ? substr($key, 9) : '--' . substr($key, 7);
                $params[$name] = $value;
            }
        }

        try {
            Artisan::call($command, $params);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('output', Artisan::output());
    }

}
