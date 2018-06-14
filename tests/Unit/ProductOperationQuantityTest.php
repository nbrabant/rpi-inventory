<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\Stock\OperationRepository as Operation;

class ProductOperationQuantityTest extends TestCase
{
    private $operation;

    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function testQuantityCounter()
    {
        $this->assertInternalType( 'int', $this->operation->countQuantityByProduct(2) );
    }
}
