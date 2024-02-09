<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CoffeePriceCalculator;
use App\Services\GoldCoffeePrice;

class CoffeeController extends Controller
{
    protected $coffeePriceCalculator;

    public function __construct(CoffeePriceCalculator $coffeePriceCalculator)
    {
        $this->coffeePriceCalculator = $coffeePriceCalculator;
    }

    public function calculate(Request $request)
    {
        // Logic to determine the type of coffee product selected
        echo $coffeeType = $request->input('coffee_type');

        // Instantiate the appropriate adapter based on the coffee type
        switch ($coffeeType) {
            case 'gold':
                $adapter = app()->make(GoldCoffeePrice::class);
                break;
            // Add cases for other coffee types if needed

            default:
                // Default to Gold Coffee adapter
                $adapter = app()->make(GoldCoffeePrice::class);
                break;
        }

        // Calculate selling price using the adapter
        $quantity = $request->input('quantity');
        $unitCost = $request->input('unit_cost');
        $sellingPrice = $adapter->calculateSellingPrice($quantity, $unitCost);

        // Return the calculated selling price
        return view('coffee_sales', compact('sellingPrice'));
    }
}
