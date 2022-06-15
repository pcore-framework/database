<?php

declare(strict_types=1);

namespace PCore\Database\Connectors;

use ArrayObject;
use PCore\Database\Contracts\ConnectorInterface;
use PCore\Database\DatabaseConfig;
use PDO;

/**
 * Class BaseConnector
 * @package PCore\Database\Connectors
 * @github https://github.com/pcore-framework/database
 */
class BaseConnector implements ConnectorInterface
{

    /**
     * @var ArrayObject
     */
    protected ArrayObject $pool;

    /**
     * @param DatabaseConfig $config
     */
    public function __construct(protected DatabaseConfig $config)
    {
        $this->pool = new ArrayObject();
    }

    /**
     * @return PDO
     */
    public function get()
    {
        $name = $this->config->getName();
        if (!$this->pool->offsetExists($name)) {
            $this->pool->offsetSet($name, $this->create());
        }
        return $this->pool->offsetGet($name);
    }

    protected function create()
    {
        $PDO = new PDO(
            $this->config->getDsn(),
            $this->config->getUser(),
            $this->config->getPassword(),
            $this->config->getOptions()
        );
        if ($PDO->query('SELECT 1')) {
            return $PDO;
        }
        $this->pool->offsetUnset($this->config->getName());
    }

}