<?php

namespace App\Application\Exceptions;

class RepositoryException extends \Exception
{
    protected $status = '422';
}