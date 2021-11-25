<?php

namespace App\Domain\Stock\Contracts;

interface OperationInterface
{
    /**
     * @var string INCREMENT_OPERATOR
     */
    public const INCREMENT_OPERATOR = '+';
    /**
     * @var string DECREMENT_OPERATOR
     */
    public const DECREMENT_OPERATOR = '-';
}