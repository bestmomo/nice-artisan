<?php

return [

    /*
    | Make commands
    */
    'make' => [
        'make:auth',
        'make:command',
        'make:event',
        'make:job',
        'make:listener',
        'make:model',
        'make:policy',
        'make:provider',
        'make:request',
        'make:test',
        'make:migration',
        'make:seeder',
        'make:controller',
        'make:middleware',
        'make:mail',
        'make:notification',
    ],  

    /*
    | Migrate commands
    */
    'migrate' => [
        'migrate',
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
        'schedule:run',
        'serve',
        'session:table',
        'storage:link',        
        'vendor:publish',
        'view:clear',
    ],
];
