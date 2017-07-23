<?php
return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'view' => [
            'template_path' => TEMPLATES,
            'twig' => [
                'cache' => CACHE,
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slimblog',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];
