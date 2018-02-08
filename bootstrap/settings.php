<?php
return [
        'displayErrorDetails' => true,
        'CSRF_SECRET' => "absolutenonesense",
        'MARQUES' => "storage/contents",
        'DRIVER' => 'sqlite',
        'MEDOO_MYSQL' => [
            'database_type' => 'mysql',
            'database_name' => '',
            'server' => 'localhost',
            'username' => '',
            'password' => '',
            'charset' => 'utf-8',
            'port' => '3306',
        ],
        'MEDOO_SQLITE' => [
                'database_type' => 'sqlite',
                'database_file' => ROOT.'storage/fe.db',
        ],
        'LOGGER' => [
            'path' => ROOT.'storage/logs/',
        ],
        'TPL'   => ROOT.'app/Views',
        'TWIG_SETTINGS' => [
                'cache' => false,
                'debug' => true,
                'autoescape' => false,
                'auto_reload' => false
        ],
];


