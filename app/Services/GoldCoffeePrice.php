<?php
namespace App\Services;

use App\Contracts\CoffeePriceCalculator;

class GoldCoffeePrice implements CoffeePriceCalculator
{
    public function calculateSellingPrice(int $quantity, float $unitCost): float
    {
        // Calculation logic specific to Gold Coffee  // 
        // let's assume a simple calculation
        $totalCost = $quantity * $unitCost;
        $sellingPrice = $totalCost * 1.25; // Assuming 25% profit margin
        return $sellingPrice;
    }
}