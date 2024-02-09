<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CoffeePriceCalculator;
use App\Services\GoldCoffeePrice;
use App\Services\ArabicCoffeePrice;
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
    
    //function to get data from the cache/or any other database system
    public function index()    
    {
        //get the cache data
        $coffeSalesData = Cache::get('coffee_sales', []);
        return view('coffee_sales', ['coffeSalesData' => $coffeSalesData]);

    }

    //function to calculate the shipping cost according to the coffee type and store to the cache
    public function store(Request $request)
    {
        // Logic to determine the type of coffee product selected
         // Validate the request data
        try{    
            $validatedData = $request->validate([
                'quantity' => 'required|integer|min:1',
                'unit_cost' => 'required|numeric|min:0.1',
                'coffee_type' => 'required|string'
            ]);
        }
        catch (ValidationException $e) {
        // Validation failed, handle the exception
        // You can access the validation errors using $e->errors() method
            return response()->json(['error' => $e->errors()], 422);
        }

        $coffeeType = $request->input('coffee_type');       

        // Instantiate the appropriate adapter based on the coffee type
        switch ($coffeeType) {
            case 'gold':
                $adapter = app()->make(GoldCoffeePrice::class);
                break;
            case 'arabic':
                    $adapter = app()->make(ArabicCoffeePrice::class);
                    break;                // Add cases for other coffee types if needed

            default:
                // Default to Gold Coffee adapter
                $adapter = app()->make(GoldCoffeePrice::class);
                break;
        }

        // Calculate selling price using the adapter
        $quantity = $request->input('quantity');
        $unitCost = $request->input('unit_cost');
        $sellingPriceData = $adapter->calculateSellingPrice($quantity, $unitCost,$coffeeType);
        //adding coffeetype to array
        $sellingPriceData =array_merge(['coffee_type' => $coffeeType], $sellingPriceData);

        // Cache the data
        $this->cacheService->store('coffee_sales', $sellingPriceData
        , 60); // Cache for 60 minutes
        //get the cache data
        $coffeSalesData = Cache::get('coffee_sales', []);
        // Return the calculated selling price
        return view('coffee_sales', ['coffeSalesData' => $coffeSalesData]);
    }
}
