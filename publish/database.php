<?php

declare(strict_types=1);

use PCore\Database\Connectors\AutoConnector;
use PCore\Database\DatabaseConfig;

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'connector' => AutoConnector::class,
            'options' => [
                DatabaseConfig::OPTION_DRIVER => 'mysql',
                DatabaseConfig::OPTION_HOST => 'localhost',
                DatabaseConfig::OPTION_PORT => 3306,
                DatabaseConfig::OPTION_POOL_SIZE => 64,
                DatabaseConfig::OPTION_UNIX_SOCKET => null,
                DatabaseConfig::OPTION_USER => 'user',
                DatabaseConfig::OPTION_PASSWORD => 'pass',
                DatabaseConfig::OPTION_DB_NAME => 'name',
                DatabaseConfig::OPTION_OPTIONS => [],
                DatabaseConfig::OPTION_CHARSET => 'utf8'
            ]
        ]
    ]
];