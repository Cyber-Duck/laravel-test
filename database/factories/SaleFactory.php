<?php

namespace Database\Factories;

use App\Models\CoffeeType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 1000),
            'unit_price' => $this->faker->randomFloat(2, 1, 3000),
            'coffee_type_id' => CoffeeType::factory()->create()->id,
            'agent_id' => User::factory()->create()->id,
        ];
    }
}
