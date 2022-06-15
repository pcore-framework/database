<?php

declare(strict_types=1);

namespace PCore\Database\Query;

/**
 * Class Expression
 * @package PCore\Database\Query
 * @github https://github.com/pcore-framework/database
 */
class Expression
{

    /**
     * @var string
     */
    protected string $expression;

    /**
     * @param string $expression
     */
    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->expression;
    }

}