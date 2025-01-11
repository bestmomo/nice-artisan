<?php

return [
    /*
    | Package settings
    */
    'settings' => [
        'route' => 'niceartisan',    
        'middlewares' => [
            'web',
            // 'nice_artisan',
        ],
    ],

    /*
    | Available commands
    */
    'commands' => [

        /*
        | Make commands
        */
        'make' => [
            'make:cast',
            'make:cache-table',
            'make:channel',
            'make:class',
            'make:command',
            'make:controller',
            'make:component',
            'make:enum',
            'make:event',
            'make:exception',
            'make:factory',
            'make:interface',
            'make:job',
            'make:job-middleware',
            'make:listener',
            'make:mail',
            'make:middleware',
            'make:migration',
            'make:model',
            'make:notification',
            'make:notifications-table',
            'make:observer',
            'make:policy',
            'make:provider',
            'make:queue-batches-table',
            'make:queue-failed-table',
            'make:queue-table',
            'make:request',
            'make:resource',
            'make:rule',
            'make:scope',
            'make:seeder',
            'make:session-table',
            'make:test',
            'make:trait',
            'make:view',            
        ],

        /*
        | Migrate commands
        */
        'migrate' => [
            'migrate',
            'migrate:fresh',
            'migrate:install',
            'migrate:rollback',
            'migrate:reset',
            'migrate:refresh',
            'migrate:status',
        ],

        /*
        | Route commands
        */
        'route' => [
            'route:cache',
            'route:clear',
            'route:list',
        ],

        /*
        | Events commands
        */
        'events' => [
            'event:generate',
            'event:cache',
            'event:clear',
            'event:list',
        ],

        /*
        | Queue commands
        */
        'queue' => [
            'queue:table',
            'queue:failed',
            'queue:retry',
            'queue:forget',
            'queue:flush',
            'queue:failed-table',
            'queue:work',
            'queue:restart',
            //'queue:listen',
            'queue:subscribe',
            'queue:table',
            'queue:batches-table',
            'queue:retry-batch',
            'queue:prune-batches',
            'queue:monitor',
            'queue:prune-failed',
        ],

        /*
        | Config commands
        */
        'config' => [
            'config:cache',
            'config:clear',
            'config:publish',
            'config:show',
        ],

        /*
        | Cache commands
        */
        'cache' => [
            'cache:clear',
            'cache:table',
            'cache:prune-stale-tags',
            'view:cache',            
        ],

        /*
        | Miscellaneous commands
        */
        'misc' => [
            'about',
            'auth:clear-resets',
            'channel:list',
            'clear-compiled',
            'completion',
            'docs',
            'down',
            'env',            
            'env:decrypt',
            'env:encrypt',
            'key:generate',
            'install:api',
            'install:broadcasting',
            'invoke-serialized-closure',
            'lang:publish',            
            'model:prune',
            'model:show',
            'optimize',
            'optimize:clear',
            'package:discover',
            'preset',
            'schedule:run',
            'schema:dump',
            'serve',
            'session:table',            
            'schedule:clear-cache',
            'schedule:interrupt',
            'storage:link',
            'storage:unlink',          
            'stub:publish',
            'test',
            'vendor:publish',
            'view:clear',
            '_complete',            
        ],

        /*
        | DB commands
        */
        'DB' => [
            'db:seed',
            'db:wipe',
            'db:monitor',
            'db:show',
            'db:table',
        ],
    ],
];
