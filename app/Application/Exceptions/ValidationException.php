<?php

namespace App\Application\Exceptions;

class ValidationException extends \Exception
{
    /**
     * @var string
     */
    protected $status = '401';
}
