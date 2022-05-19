<?php

namespace App\Jobs;

use App\Models\CoffeeType;
use App\Models\Sale;
use App\Models\ShippingCost;

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
        $shippingCost = ShippingCost::where('active', true)->orderBy('id', 'DESC')->firstOrFail();

        (new Sale([
            'quantity' => $this->quantity,
            'unit_price' => $this->unitCost,
            'selling_price' => $this->sellersCost,
            'coffee_type_id' => $coffeeType->id,
            'shipping_cost_id' => $shippingCost->id,
            'agent_id' => $this->userId
        ]))->saveOrFail();
    }
}
