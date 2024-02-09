<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CoffeePriceCalculator;
use App\Services\GoldCoffeePrice;
use App\Services\CacheService;

use Illuminate\Support\Facades\Cache;

class CoffeeController extends Controller
{
    protected $coffeePriceCalculator;

    public function __construct(CoffeePriceCalculator $coffeePriceCalculator, CacheService $cacheService)
    {
        $this->coffeePriceCalculator = $coffeePriceCalculator;
        $this->cacheService = $cacheService;
    }

    public function calculate(Request $request)
    {
        // Logic to determine the type of coffee product selected
        $coffeeType = $request->input('coffee_type');

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
        $sellingPriceData = $adapter->calculateSellingPrice($quantity, $unitCost);

        // Cache the data
        $this->cacheService->store('coffee_sales', $sellingPriceData
        , 60); // Cache for 60 minutes
        //get the cache data
        $coffeSalesData = Cache::get('coffee_sales', []);


        // Return the calculated selling price
        return view('coffee_sales', ['coffeSalesData' => $coffeSalesData]);
    }
}
