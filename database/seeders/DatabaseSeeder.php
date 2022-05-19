<?php

namespace Database\Seeders;

use App\Models\CoffeeType;
use App\Models\ShippingCost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // default user
        User::factory()->create([
            'name' => 'Sales Agent',
            'email' => 'sales@coffee.shop',
        ]);

        // default shipping cost
        ShippingCost::factory()->create([
           'cost' => 10.00,
           'active' => true,
        ]);

        // default coffee types
        collect([['Gold', 0.25], ['Arabic', 0.15]])
            ->each(fn ($values) => CoffeeType::factory()->create(
                [
                    'name' => $values[0],
                    'profit_margin' => $values[1],
                ])
            );
    }
}
