<?php

namespace Bestmomo\NiceArtisan\Http\Controllers;

use Bestmomo\NiceArtisan\Http\Kernel;
use AppController;
use Artisan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NiceArtisanController extends AppController
{
    /**
     * All core commands.
     *
     */
    protected $coreCommands = [
        'help',
        'list',
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
        'queue:monitor',
        'queue:prune-failed',
        'make:controller',
        'make:middleware',
        'session:table',
        'queue:work',
        'queue:restart',
        'queue:listen',
        'queue:prune-batches',
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
        'make:channel',
        'make:observer',
        'event:list',
        'event:clear',
        'view:cache',
        'event:cache',
        'optimize:clear',
        'db:wipe',
        'make:component',
        'stub:publish',
        'test',
        'schema:dump',
        'make:cast',
        'queue:batches-table',
        'queue:retry-batch',
        'queue:clear',
        'schedule:work',
        'schedule:list',
        'schedule:test',
        'db',
        'model:prune',
        '_complete',
        'completion',
        'schedule:clear-cache',
        'make:scope',
        'about',
        'model:show',
        'docs',
        'db:monitor',
        'db:show',
        'db:table',
        'env:decrypt',
        'env:encrypt',
        'cache:prune-stale-tags',
        'make:view',
        'lang:publish',
        'channel:list',
        'config:show',
        'schedule:interrupt',
        'make:cache-table',
        'make:class',
        'make:enum',
        'make:notifications-table',
        'make:queue-batches-table',
        'make:queue-failed-table',
        'make:queue-table',
        'make:session-table',
        'make:trait',
        'config:publish',
        'install:api',
        'make:interface',
        'storage:unlink',
        'install:broadcasting',
    ];

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

        ksort($items);

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

        return back()->with('output', Artisan::output());
    }
}
