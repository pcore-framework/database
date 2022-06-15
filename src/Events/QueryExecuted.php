<?php

declare(strict_types=1);

namespace PCore\Database\Events;

/**
 * Class QueryExecuted
 * @package PCore\Database\Events
 * @github https://github.com/pcore-framework/database
 */
class QueryExecuted
{

    public function __construct(
        public string $query,
        public array $bindings,
        public float $duration
    )
    {
    }

}