<?php

namespace App\Jobs;

use App\Models\CoffeeType;
use App\Models\ShippingCost;

class CalculateSellingPrice
{
    public function __construct(
        private CoffeeType $coffeeType,
        private int        $quantity,
        private float      $unitPrice
    )
    {
    }

    public function handle()
    {
        // Get the latest active shipping cost
        $shippingCost = ShippingCost::where('active', true)->orderBy('id', 'DESC')->firstOrFail();

        $sellersCostRaw = (($this->quantity * $this->unitPrice) / (1 - $this->coffeeType->profit_margin)) + $shippingCost->cost;
        return ceil($sellersCostRaw * 100) / 100; // always round up the nearest 100th
    }
}
