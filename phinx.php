<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        'production' => [
            'adapter' => getenv('PHINX_DATABASE_ADAPTER'),
            'host' => getenv('DATABASE_HOST'),
            'name' => getenv('DATABASE_DBNAME'),
            'user' => getenv('DATABASE_USER'),
            'pass' => getenv('DATABASE_PASSWORD'),
            'port' => '5432',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
