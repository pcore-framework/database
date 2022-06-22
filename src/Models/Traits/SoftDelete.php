<?php

declare(strict_types=1);

namespace PCore\Database\Models\Traits;

/***
 * Trait SoftDelete
 * @package PCore\Database\Models\Traits
 * @github https://github.com/pcore-framework/database
 */
trait SoftDelete
{

    protected string $delete_at = 'delete_at';

    public function withTrashed()
    {
    }

    public function onlyTrashed()
    {
        return $this->whereNotNull($this->delete_at);
    }

}