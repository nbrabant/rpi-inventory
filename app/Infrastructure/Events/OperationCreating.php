<?php

namespace App\Infrastructure\Events;

use App\Domain\Stock\Entities\Operation;
use Illuminate\Queue\SerializesModels;

class OperationCreating
{
    use SerializesModels;

    /**
     * @var Operation $operation
     */
    private Operation $operation;

    /**
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }
}