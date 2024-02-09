<?php
namespace App\Services;
use Illuminate\Support\Facades\Config;

use App\Contracts\CoffeePriceCalculator;

class GoldCoffeePrice implements CoffeePriceCalculator
{
    public function calculateSellingPrice(int $quantity, float $unitCost): array
    {
        //geting profit margin and shipping cost
        $shippingCost = config('sales.shipping_cost');
        $profitMargin = config('sales.profit_margin');

        // Calculation logic specific to Gold Coffee  // 
        $totalCost = $quantity * $unitCost;
        $sellingPrice = ($totalCost / (1 -$profitMargin )) + $shippingCost; 

        // Store the data for displaying in the grid
        $data = [
            'quantity' => $quantity,
            'unitCost' => $unitCost,
            'sellingPrice' => number_format($sellingPrice,2),
        ];
        return $data;
    }
}