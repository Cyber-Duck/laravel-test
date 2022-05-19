<?php

namespace Tests\Feature\Api;

use App\Models\CoffeeType;
use App\Models\ShippingCost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateSalesTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private CoffeeType $coffeeType;
    private ShippingCost $shippingCost;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->coffeeType = CoffeeType::factory()->create(['name' => 'French Blend']);
        $this->shippingCost = ShippingCost::factory()->create([
            'active' => true,
            'cost' => 10.00
        ]);
        $this->user = User::factory()->create();
        $this->be($this->user);
    }

    public function test_200_response_with_valid_params()
    {
        $this->post(
            "/sales",
            ['quantity' => 1, 'unit_cost' => 10.50, 'coffee_type' => $this->coffeeType->id, 'selling_price' => 35.50],
            ['Accept' => 'application/json']
        )->assertStatus(302);
    }

    public function test_422_response_for_invalid_coffee_type()
    {
        $this->post(
            '/sales',
            ['quantity' => 1, 'unit_cost' => 10.50, 'coffee_type' => 999, 'selling_price' => 35.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }

    public function test_422_response_for_invalid_quantity()
    {
        $this->post(
            '/sales',
            ['quantity' => 0, 'unit_cost' => 10.50, 'coffee_type' => $this->coffeeType->id, 'selling_price' => 35.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            '/sales',
            ['quantity' => 0.2, 'unit_cost' => 10.50, 'coffee_type' => $this->coffeeType->id, 'selling_price' => 35.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }

    public function test_422_response_for_invalid_unit_cost()
    {
        $this->post(
            '/sales',
            ['quantity' => 10, 'unit_cost' => 0.0, 'coffee_type' => $this->coffeeType->id, 'selling_price' => 35.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            '/sales',
            ['quantity' => 1, 'unit_cost' => -10.50, 'coffee_type' => $this->coffeeType->id, 'selling_price' => 35.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }

    public function test_422_response_for_invalid_selling_price()
    {
        $this->post(
            '/sales',
            ['quantity' => 10, 'unit_cost' => 5.50, 'coffee_type' => $this->coffeeType->id, 'selling_price' => 0.00],
            ['Accept' => 'application/json']
        )->assertStatus(422);

        $this->post(
            '/sales',
            ['quantity' => 1, 'unit_cost' => 10.50, 'coffee_type' => $this->coffeeType->id, 'selling_price' => -35.50],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }
}
