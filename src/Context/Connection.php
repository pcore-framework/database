<?php

declare(strict_types=1);

namespace PCore\Database\Context;

use ArrayObject;
use PCore\Database\Connectors\PoolConnector;
use Throwable;

/**
 * Class Connection
 * @package PCore\Database\Context
 * @github https://github.com/pcore-framework/database
 */
class Connection extends ArrayObject
{

    public function __destruct()
    {
        foreach ($this->getIterator() as $item) {
            /** @var PoolConnector $pool */
            $pool = $item['pool'];
            /** @var \PDO $PDO */
            $PDO = $item['item'];
            try {
                if (!$PDO->query('SELECT 1')) {
                    $PDO = null;
                }
            } catch (Throwable) {
                $PDO = null;
            } finally {
                $pool->put($PDO);
            }
        }
    }

}