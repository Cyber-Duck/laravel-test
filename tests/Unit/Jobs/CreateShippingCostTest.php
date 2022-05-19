<?php

namespace Tests\Unit\Jobs;

use App\Jobs\CreateShippingCost;
use App\Jobs\CreateShippingCosts;
use App\Models\ShippingCost;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateShippingCostTest extends \Tests\TestCase
{
    use RefreshDatabase;

    private ShippingCost $shippingCostActive;
    private ShippingCost $shippingCostInactive;

    public function setUp(): void
    {
        parent::setUp();
        $this->shippingCostActive = ShippingCost::factory()->create([
            'active' => true,
            'cost' => 10.00
        ]);
        $this->shippingCostInactive = ShippingCost::factory()->create([
            'active' => false,
            'cost' => 15.00
        ]);
    }

    public function test_it_stores_shipping_cost_and_marks_others_inactive()
    {
        (new CreateShippingCost(5.00))->handle();
        $this->assertDatabaseHas('shipping_costs', ['cost' => 5.00, 'active' => true]);
        $this->assertDatabaseHas('shipping_costs', ['id' => $this->shippingCostActive->id, 'active' => false]);
        $this->assertDatabaseHas('shipping_costs', ['id' => $this->shippingCostInactive->id, 'active' => false]);
    }
}
