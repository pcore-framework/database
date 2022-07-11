<?php

declare(strict_types=1);

namespace PCore\Database\Connectors;

use ArrayObject;
use PCore\Context\Context;
use PCore\Database\Context\Connection;
use PCore\Database\Contracts\{ConnectorInterface, PoolInterface};
use PCore\Database\DatabaseConfig;
use PDO;
use Swoole\Coroutine\Channel;

/**
 * Class PoolConnector
 * @package PCore\Database\Connectors
 * @github https://github.com/pcore-framework/database
 */
class PoolConnector implements ConnectorInterface, PoolInterface
{

    /**
     * @var Channel
     */
    protected Channel $pool;

    /**
     * @var int
     */
    protected int $capacity;

    /**
     * @var int
     */
    protected int $size = 0;

    /**
     * @param DatabaseConfig $config
     */
    public function __construct(protected DatabaseConfig $config)
    {
        $this->pool = new Channel($this->capacity = $config->getPoolSize());
        if ($config->isAutofill()) {
            $this->fill();
        }
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $name = $this->config->getName();
        $key = Connection::class;
        if (!Context::has($key)) {
            Context::put($key, new Connection());
        }
        /** @var ArrayObject $connection */
        $connection = Context::get($key);
        $connection->offsetSet($name, [
            'pool' => $this,
            'item' => $this->size < $this->capacity ? $this->create() : $this->pool->pop(3),
        ]);
        return $connection->offsetGet($name)['item'];
    }

    /**
     * @return PDO
     */
    protected function create()
    {
        $PDO = new PDO(
            $this->config->getDsn(),
            $this->config->getUser(),
            $this->config->getPassword(),
            $this->config->getOptions()
        );
        ++$this->size;
        return $PDO;
    }

    /**
     * Возвращает соединение, если соединение не может быть использовано, вернет значение null
     *
     * @param $PDO
     */
    public function put($PDO)
    {
        if (is_null($PDO)) {
            --$this->size;
        } elseif (!$this->pool->isFull()) {
            $this->pool->push($PDO);
        }
    }

    /**
     * Заполнять пул подключениями
     */
    public function fill()
    {
        for ($i = 0; $i < $this->capacity; ++$i) {
            $this->put($this->create());
        }
        $this->size = $this->capacity;
    }

}