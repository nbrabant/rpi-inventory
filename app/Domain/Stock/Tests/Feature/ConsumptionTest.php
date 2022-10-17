<?php

use App\Domain\Stock\Entities\Category;
use App\Domain\Stock\Entities\Product;
use Database\Seeders\CategoryTableSeeder;
use Tests\TestCase;

class ConsumptionTest extends TestCase
{
    const PRODUCT_NAME = 'Consumption Test Name';
    const PRODUCT_DATA = [
        'quantity' => 0,
        'status' => 'alert-success',
        'category_id' => 9,
        'name' => self::PRODUCT_NAME,
        'description' => 'Description',
        'min_quantity' => 0,
        'unit' => 'piece',
    ];

    private string $productId;
    private string $productName = '';

    protected function setUp(): void
    {
        parent::setUp();
        $cat = Category::all('*')->first();
        if (empty($cat)) {
            (new CategoryTableSeeder)->run();
        }

        // remove article if already created
        $product = Product::where('name', self::PRODUCT_NAME);
        $product->delete();
    }

    protected function tearDown(): void
    {
        Category::truncate();
        // clean up
        $product = Product::where('name', self::PRODUCT_NAME);
        $product->delete();
        parent::tearDown();
    }

    public function test_add_consumptions()
    {
        $resp = $this->post('/api/products', self::PRODUCT_DATA);
        $decoded = $resp->decodeResponseJson();
        $this->productId = $decoded['id'];

        $consumptionData = [
            'created' => true,
            'detail' => 'Bought in shop',
            'operation' => '+',
            'product_id' => $this->productId,
            'quantity' => 2,
        ];

        // add quantity 2
        $addResp = $this->post('/api/consumptions', $consumptionData);
        $this->assertEquals(201, $addResp->getStatusCode());
        // add quantity 2 again
        $addResp = $this->post('/api/consumptions', $consumptionData);
        $this->assertEquals(201, $addResp->getStatusCode());

        $resp = $this->get("/api/products/$this->productId");
        $decoded = $resp->decodeResponseJson();
        $this->assertEquals(4, $decoded['quantity']);

        // sub quantity
        $subData = [
            'created' => true,
            'detail' => 'Used',
            'operation' => '-',
            'product_id' => $this->productId,
            'quantity' => 4,
        ];
        $subResp = $this->post('/api/consumptions', $subData);
        $this->assertEquals(201, $subResp->getStatusCode());

        $resp = $this->get("/api/products/$this->productId");
        $decoded = $resp->decodeResponseJson();
        $this->assertEquals(0, $decoded['quantity']);
    }
}
