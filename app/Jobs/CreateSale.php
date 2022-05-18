<?php

namespace App\Jobs;

use App\Models\CoffeeType;
use App\Models\Sale;

class CreateSale
{
    public function __construct(
        private int   $userId,
        private int   $coffeeType,
        private int   $quantity,
        private float $unitCost,
        private float $sellersCost
    )
    {
    }

    public function handle(): void
    {
        $coffeeType = CoffeeType::findOrFail($this->coffeeType);

        (new Sale([
            'quantity' => $this->quantity,
            'unit_price' => $this->unitCost,
            'selling_price' => $this->sellersCost,
            'coffee_type_id' => $coffeeType->id,
            'agent_id' => $this->userId
        ]))->saveOrFail();
    }
}
