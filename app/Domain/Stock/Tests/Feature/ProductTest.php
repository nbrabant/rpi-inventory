<?php

use App\Domain\Stock\Entities\Category;
use App\Domain\Stock\Entities\Product;
use Database\Seeders\CategoryTableSeeder;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private int $productId;

    protected function setUp(): void
    {
        parent::setUp();
        $cat = Category::all('*')->first();
        if (empty($cat)) {
            (new CategoryTableSeeder)->run();
        }
    }

    protected function tearDown(): void
    {
        Category::truncate();
        // clean up
        $product = Product::where('id', $this->productId);
        $product->delete();
        parent::tearDown();
    }

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
        $this->productId = $decoded['id'];

        $resp = $this->get("/api/products/$this->productId");
        $decoded = $resp->decodeResponseJson();
        $this->assertEquals(0, $decoded['quantity']);
    }
}
