<?php

namespace Tests\Feature\Api;

use App\Models\CoffeeType;
use App\Models\ShippingCost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalculateCostTest extends TestCase
{
    use RefreshDatabase;
    private CoffeeType $coffeeType;
    private ShippingCost $shippingCost;

    public function setUp(): void
    {
        parent::setUp();
        $this->coffeeType = CoffeeType::factory()->create(['name' => 'French Blend']);
        $this->shippingCost = ShippingCost::factory()->create([
            'active' => true,
            'cost' => 10.00
        ]);
    }

    public function test_200_response_with_valid_params()
    {
        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => 1, 'unit_price' => 10],
            ['Accept' => 'application/json']
        )->assertStatus(200);
    }

    public function test_404_response_for_invalid_coffee_type()
    {
        $this->post('/api/calculate-cost/999')->assertStatus(404);
    }

    public function test_422_response_for_invalid_quantity()
    {
        // 0, less than 0, float, empty
        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => 0, 'unit_price' => 5.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => -1, 'unit_price' => 5.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => 0.5, 'unit_price' => 5.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['unit_price' => 5.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }

    public function test_422_response_for_invalid_unit_cost()
    {
        // 0, less than 0, empty
        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => 1, 'unit_price' => 0],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => 1, 'unit_price' => -5.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            "/api/calculate-cost/{$this->coffeeType->id}",
            ['quantity' => 1],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }
}
