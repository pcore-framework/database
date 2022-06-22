<?php

declare(strict_types=1);

namespace PCore\Database\Models\Relations;

use PCore\Database\Models\{Builder, Model};

/**
 * Class HasMany
 * @package PCore\Database\Models\Relations
 * @github https://github.com/pcore-framework/database
 */
class HasMany
{

    public function __construct(Builder $builder, Model $owner, $foreignKey, $localKey)
    {

    }

}