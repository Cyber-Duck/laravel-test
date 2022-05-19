<?php

namespace Tests\Unit\Jobs;

use App\Jobs\CalculateSellingPrice;
use App\Models\CoffeeType;
use App\Models\ShippingCost;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculateSellersCostTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        ShippingCost::factory()->create(['active' => true, 'cost' => 10.00]);
    }

    /**
     * @dataProvider costCalculatorParams
     */
    public function test_it_correctly_calculates_cost(CoffeeType $type, int $quantity, float $cost, float $expected)
    {
        $this->assertEquals($expected, (new CalculateSellingPrice($type, $quantity, $cost))->handle());
    }

    public function costCalculatorParams(): array
    {
        $coffeeType = new CoffeeType([
            'name' => 'test',
            'profit_margin' => 0.25,
        ]);

        return [
            [$coffeeType, 1, 10.00, 23.34],
            [$coffeeType, 2, 20.50, 64.67],
            [$coffeeType, 5, 12.00, 90.00],
        ];
    }
}
