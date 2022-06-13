<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_record_sale()
    {
        $product = Product::first();

        $result = Sale::recordSale($product->id, 1, 2, 3);
        $this->assertNotNull($result);

        $this->assertNotNull($result->product);

        $this->assertEquals($product->id, $result->product_id);
        $this->assertEquals(1, $result->quantity);
        $this->assertEquals(2, $result->unit_cost);
        $this->assertEquals(3, $result->selling_price);
        $this->assertNotNull($result->created_at);
        $this->assertNotNull($result->updated_at);
        $this->assertNotNull($result->id);
    }
}
