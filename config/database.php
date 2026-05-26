<?php

return [
    'default' => env('DB_CONNECTION', 'oracle'),
    
    'connections' => [
        'oracle' => [
            'driver'         => 'oracle',
            'tns'            => env('DB_TNS', ''),
            'host'           => env('DB_HOST', 'localhost'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'XE'),
            'service_name'   => env('DB_SERVICE_NAME', ''),
            'username'       => env('DB_USERNAME', 'system'),
            'password'       => env('DB_PASSWORD', 'oracle'),
            'charset'        => 'AL32UTF8',
            'prefix'         => env('DB_PREFIX', ''),
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
            'edition'        => env('DB_EDITION', 'ora$base'),
            'server_version' => env('DB_SERVER_VERSION', '11g'),
        ],
    ],
];
