<?php

declare(strict_types=1);

namespace PCore\Database;

use ArrayObject;
use InvalidArgumentException;
use PCore\Config\Contracts\ConfigInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class Manager
 * @package PCore\Database
 * @github https://github.com/pcore-framework/database
 */
class Manager
{

    /**
     * @var string|mixed
     */
    protected string $defaultConnection;

    /**
     * @var ArrayObject
     */
    protected ArrayObject $connections;

    /**
     * @var array|mixed
     */
    protected array $config = [];

    /**
     * @param ConfigInterface $config
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(ConfigInterface $config, protected ?EventDispatcherInterface $eventDispatcher = null)
    {
        $config = $config->get('database');
        $this->defaultConnection = $config['default'];
        $this->connections = new ArrayObject();
        $this->config = $config['connections'] ?? [];
    }

    /**
     * @param string|null $name
     * @return Query
     */
    public function connection(?string $name = null)
    {
        $name ??= $this->defaultConnection;
        if (!$this->connections->offsetExists($name)) {
            if (!isset($this->config[$name])) {
                throw new InvalidArgumentException('Нет соответствующего подключения к базе данных');
            }
            $config = $this->config[$name];
            $connector = $config['connector'];
            $options = $config['options'];
            $options['name'] = $name;
            $this->connections->offsetSet($name, new $connector(new DatabaseConfig($options)));
        }
        return new Query($this->connections->offsetGet($name), $this->eventDispatcher);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return $this->connection($this->defaultConnection)->{$name}(...$arguments);
    }

}