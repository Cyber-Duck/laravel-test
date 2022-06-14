<?php

namespace Tests\Feature;

use App\Http\Livewire\RecordSales;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RecordSalesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_record_a_sale()
    {
        $user = User::factory()->create();

        $product = Product::first();

        $this->actingAs($user);

        Livewire::test(RecordSales::class)
            ->set('product', $product->id)
            ->set('quantity', 1)
            ->set('unitCost', 10)
            ->call('submit')
            ->assertStatus(200);

        // lets validate the selling price
        $sale = Sale::latest('id')
            ->first();

        $this->assertEquals(23.33, $sale->selling_price);
    }
}
