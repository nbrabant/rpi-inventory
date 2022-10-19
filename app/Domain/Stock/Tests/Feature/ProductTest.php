<?php

use App\Domain\Stock\Entities\Category;
use App\Domain\Stock\Entities\Product;
use Database\Seeders\CategoryTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product_and_check_initial_quantity()
    {
        $postData = [
            'quantity'     => 0,
            'status'       => 'alert-success',
            'category_id'  => '9',
            'name'         => 'Test Name',
            'description'  => 'Description',
            'min_quantity' => 0,
            'unit'         => "piece"
        ];

        $resp = $this->post('/api/products', $postData);
        $this->assertEquals(201, $resp->getStatusCode());
        $decoded = $resp->decodeResponseJson();
        $productId = $decoded['id'];

        $resp = $this->get("/api/products/$productId");
        $decoded = $resp->decodeResponseJson();
        $this->assertEquals(0, $decoded['quantity']);
    }
}
