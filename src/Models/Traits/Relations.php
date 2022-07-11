<?php

declare(strict_types=1);

namespace PCore\Database\Models\Traits;

use PCore\Database\Models\Model;
use PCore\Database\Models\Relations\HasMany;

/**
 * Trait Relations
 * @package PCore\Database\Models\Traits
 * @github https://github.com/pcore-framework/database
 */
trait Relations
{

    protected function hasOne($related, $foreignKey = null, $localKey = null)
    {

    }

    protected function hasMany($related, $foreignKey = null, $localKey = null)
    {
        /** @var Model $entity */
        $entity = new $related();
        $foreignKey ??= $entity->getTable() . '_id';
        return new HasMany($entity->newQuery(), $this, $this->getTable() . '.' . $foreignKey, $localKey);
    }

}