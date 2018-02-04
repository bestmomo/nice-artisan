<?php

return [
    /*
    | Package settings
    */
    'settings' => [
        'route' => 'niceartisan',
    ],

    /*
    | Available commands
    */
    'commands' => [

        /*
        | Make commands
        */
        'make' => [
            'make:auth',
            'make:command',
            'make:controller',
            'make:event',
            'make:exception',
            'make:factory',
            'make:job',
            'make:listener',
            'make:mail',
            'make:middleware',
            'make:migration',
            'make:model',
            'make:notification',
            'make:policy',
            'make:provider',
            'make:request',
            'make:resource',
            'make:rule',
            'make:seeder',
            'make:test',
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
        ],    
        
        /*
        | Config commands
        */
        'config' => [
            'config:cache',
            'config:clear',
        ],
        
        /*
        | Cache commands
        */
        'cache' => [
            'cache:clear',
            'cache:table',
        ],
        
        /*
        | Miscellaneous commands
        */
        'miscellaneous' => [
            'app:name', 
            'auth:clear-resets',
            'clear-compiled',
            'db:seed',
            'event:generate',
            'down',
            'env',
            'key:generate',
            'optimize',
            'package:discover',
            'preset',
            'schedule:run',
            'serve',
            'session:table',
            'storage:link',
            'vendor:publish',
            'view:clear',
        ],
    ],
];
