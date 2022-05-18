<?php

namespace Tests\Unit\Jobs;

use App\Jobs\CalculateSellingPrice;
use App\Jobs\CreateSale;
use App\Models\CoffeeType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSaleTest extends \Tests\TestCase
{
    use RefreshDatabase;

    private CoffeeType $coffeeType;

    public function setUp(): void
    {
        parent::setUp();
        $this->coffeeType = CoffeeType::factory()->create(['name' => 'French Blend']);
        $this->user = User::factory()->create();
    }

    public function test_it_stores_sale()
    {
        (new CreateSale($this->user->id, $this->coffeeType->id, 10, 10, 150.50))->handle();
        $this->assertDatabaseHas(
            'sales',
            ['coffee_type_id' => $this->coffeeType->id, 'agent_id' => $this->user->id, 'selling_price' => '150.50']
        );
    }
}
