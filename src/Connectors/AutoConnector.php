<?php

declare(strict_types=1);

namespace PCore\Database\Connectors;

use PCore\Database\Contracts\ConnectorInterface;
use PCore\Database\DatabaseConfig;

/**
 * Class AutoConnector
 * @package PCore\Database\Connectors
 * @github https://github.com/pcore-framework/database
 */
class AutoConnector implements ConnectorInterface
{

    /**
     * @var array|string[]
     */
    protected array $connectors = [
        'pool' => PoolConnector::class,
        'base' => BaseConnector::class
    ];

    /**
     * @var array
     */
    protected array $container = [];

    /**
     * @param DatabaseConfig $config
     */
    public function __construct(protected DatabaseConfig $config)
    {
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $type = 'base';
        if (class_exists('Swoole\Coroutine')) {
            if (\Swoole\Coroutine::getCid() > 0) {
                $type = 'pool';
            }
        }
        if (!isset($this->container[$type])) {
            $connector = $this->connectors[$type];
            $this->container[$type] = new $connector($this->config);
        }
        return $this->container[$type]->get();
    }

}