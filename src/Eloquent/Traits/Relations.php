<?php

declare(strict_types=1);

namespace PCore\Database\Eloquent\Traits;

use PCore\Database\Eloquent\Model;
use PCore\Database\Eloquent\Relations\HasMany;

/**
 * Trait Relations
 * @package PCore\Database\Eloquent\Traits
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
        $entity = new $related;
        $foreignKey ??= $entity->getTable() . '_id';
        return new HasMany($entity->newQuery(), $this, $this->getTable() . '.' . $foreignKey, $localKey);
    }

}