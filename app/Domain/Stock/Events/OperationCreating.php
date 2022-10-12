<?php

namespace App\Domain\Stock\Events;

use App\Domain\Stock\Entities\Operation;
use Illuminate\Queue\SerializesModels;

class OperationCreating
{
    use SerializesModels;

    /**
     * @param Operation $operation
     */
    public function __construct(
        private Operation $operation
    ) {}

    public function getOperation(): Operation
    {
        return $this->operation;
    }
}