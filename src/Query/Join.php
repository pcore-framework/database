<?php

declare(strict_types=1);

namespace PCore\Database\Query;

/**
 * Class Join
 * @package PCore\Database\Query
 * @github https://github.com/pcore-framework/database
 */
class Join
{

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @var string
     */
    public string $table;

    /**
     * @var ?string
     */
    public ?string $alias = null;

    /**
     * @var string
     */
    public string $league;

    /**
     * @var array
     */
    public array $on = [];

    /**
     * @param Builder $builder
     * @param string $table
     * @param string|null $alias
     * @param string $league
     */
    public function __construct(Builder $builder, string $table, ?string $alias = null, string $league = 'INNER JOIN')
    {
        $this->builder = $builder;
        $this->table = $table;
        $this->league = $league;
        $this->alias = $alias;
    }

    /**
     * @param $first
     * @param $last
     * @param string $operator
     * @return Builder
     */
    public function on($first, $last, string $operator = '=')
    {
        $this->on = [$first, $operator, $last];
        return $this->builder;
    }

    /**
     * @param $method
     * @param $args
     * @return Builder
     */
    public function __call($method, $args)
    {
        return $this->builder->{$method}(...$args);
    }

}