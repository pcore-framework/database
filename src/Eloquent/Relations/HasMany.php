<?php

declare(strict_types=1);

namespace PCore\Database\Eloquent\Relations;

use PCore\Database\Eloquent\Builder;
use PCore\Database\Eloquent\Model;

/**
 * Class HasMany
 * @package PCore\Database\Eloquent\Relations
 * @github https://github.com/pcore-framework/database
 */
class HasMany
{

    public function __construct(Builder $builder, Model $owner, $foreignKey, $localKey)
    {

    }

}