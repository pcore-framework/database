<?php

declare(strict_types=1);

namespace PCore\Database\Contracts;

/**
 * Interface PoolInterface
 * @package PCore\Database\Contracts
 * @github https://github.com/pcore-framework/database
 */
interface PoolInterface
{

    public function get();

    public function put($poolable);

}