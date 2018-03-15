<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{
    /**
     * @var string
     */
    protected $status = '401';
}
