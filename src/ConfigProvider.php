<?php

declare(strict_types=1);

namespace PCore\Database;

/**
 * Class ConfigProvider
 * @package PCore\Database
 * @github https://github.com/pcore-framework/database
 */
class ConfigProvider
{

    public function __invoke(): array
    {
        return [
            'publish' => [
                [
                    'name' => 'database',
                    'source' => __DIR__ . '/../publish/database.php',
                    'destination' => dirname(__DIR__, 4) . '/config/database.php'
                ]
            ]
        ];
    }

}