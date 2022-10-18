<?php

use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Entities\ProductLine;
use App\Domain\Stock\Entities\Product;
use Database\Seeders\ProductTableSeeder;
use Tests\TestCase;

class CartTest extends TestCase
{
    private int $productId = 1;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        Product::truncate();
        Cart::truncate();
        ProductLine::truncate();
        parent::tearDown();
    }

    public function test_add_product_to_cart()
    {
        (new ProductTableSeeder())->run();
        $postData = ['product_id' => $this->productId, 'quantity' => 0];
        $resp = $this->post('/api/cartproducts', $postData);
        $decoded = $resp->decodeResponseJson();
        $this->assertArrayHasKey('product_lines', $decoded, 'Missing product lines key');
        $this->assertCount(1, $decoded['product_lines'], 'Seems like a product_lines count');
        $this->assertArrayHasKey('id', $decoded['product_lines'][0], 'Missing id');
        // clean up cart
        $resp = $this->delete(sprintf('/api/cartproducts/%s', $this->productId), ['product_id' => $this->productId]);
        $this->assertEquals(200, $resp->status(), 'Wrong status code returned for deletion');
        $decoded = $resp->decodeResponseJson();
        $this->assertArrayHasKey('id', $decoded, 'No id returned after deletion');
    }

    public function test_add_and_update_product_in_cart()
    {
        (new ProductTableSeeder())->run();
        $newQuantity = 666;
        $postData = ['product_id' => $this->productId, 'quantity' => 0];
        $this->post('/api/cartproducts', $postData);
        $resp = $this->patch('/api/cartproducts/1', [
            'cart_id' => 1,
            'id' => 1,
            'product_id' => $this->productId,
            'quantity' => $newQuantity
        ]);
        $decoded = $resp->decodeResponseJson();
        $this->assertArrayHasKey('product_lines', $decoded, 'missing index product_lines');
        $this->assertCount(1, $decoded['product_lines'], 'Wrong count');
        $this->assertEquals($this->productId, $decoded['product_lines'][0]['product_id']);
        $this->assertEquals($newQuantity, $decoded['product_lines'][0]['quantity']);

        // clean up cart
        $resp = $this->delete(sprintf('/api/cartproducts/%s', $this->productId), ['product_id' => $this->productId]);
        $this->assertEquals(200, $resp->status(), 'Wrong status code returned for deletion');
        $decoded = $resp->decodeResponseJson();
        $this->assertArrayHasKey('id', $decoded, 'No id returned after deletion');
    }

    public function test_add_and_finish_cart()
    {
        (new ProductTableSeeder())->run();
        $postData = ['product_id' => $this->productId, 'quantity' => 0];
        $resp = $this->post('/api/cartproducts', $postData);
        $decoded = $resp->decodeResponseJson();
        $cartId = $decoded['product_lines'][0]['cart_id'];
        $resp = $this->patch("/api/carts/$cartId", ['finished' => true]);
        $decoded = $resp->decodeResponseJson();
        $this->assertCount(0, $decoded['product_lines']);
    }
}
