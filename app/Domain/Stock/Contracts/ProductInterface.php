<?php

namespace App\Domain\Stock\Contracts;

interface ProductInterface
{
    /**
     * @var string STATUS_SUCCESS
     */
    public const STATUS_SUCCESS = 'alert-success';
    /**
     * @var string STATUS_WARNING
     */
    public const STATUS_WARNING = 'alert-warning';
    /**
     * @var string STATUS_DANGER
     */
    public const STATUS_DANGER = 'alert-danger';
}