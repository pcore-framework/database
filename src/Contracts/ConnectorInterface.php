<?php

declare(strict_types=1);

namespace PCore\Database\Contracts;

use PCore\Database\DatabaseConfig;

/**
 * Interface ConnectorInterface
 * @package PCore\Database\Contracts
 * @github https://github.com/pcore-framework/database
 */
interface ConnectorInterface
{

    public function __construct(DatabaseConfig $config);

    public function get();

}