<?php

declare(strict_types=1);

namespace PCore\Database\Contracts;

/**
 * Interface QueryInterface
 * @package PCore\Database\Contracts
 * @github https://github.com/pcore-framework/database
 */
interface QueryInterface
{

    public function statement(string $query, array $bindings = []);

}