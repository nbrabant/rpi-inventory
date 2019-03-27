<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Domain\Stock\Repositories\OperationRepository as Operation;

class ProductOperationQuantityTest extends TestCase
{

    public function testQuantityCounter()
    {
        $this->assertTrue(true);
        $operation = new Operation(app());
        $this->assertInternalType( 'int', $operation->countQuantityByProduct(2) );
    }
}
