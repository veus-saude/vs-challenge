<?php

return [

    'default' => 'veus',

    'connections' => [
        'veus' => [
            'driver' => 'sqlite',
            'database' =>  storage_path('sqlite/veus.sqlite'),
            'prefix' => ''
        ]
    ],
    'fetch' => PDO::FETCH_CLASS,
    'migrations' => 'migrations'
];