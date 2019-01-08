<?php

$config['database'] = [
    'default'       => 'pgsql',

    'connections'   => [
        'pgsql'     => [
            'driver'    => 'pgsql',
            'host'      => 'localhost',
            'database'  => 'ada',
            'username'  => 'postgres',
            'password'  => 'david23',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]
    ]
];