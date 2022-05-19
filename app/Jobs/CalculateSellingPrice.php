<?php

namespace App\Jobs;

use App\Models\CoffeeType;

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
        $sellersCostRaw = (($this->quantity * $this->unitPrice) / (1 - $this->coffeeType->profit_margin)) + $this->coffeeType->shipping_costs;
        return ceil($sellersCostRaw * 100) / 100; // always round up the nearest 100th
    }
}
