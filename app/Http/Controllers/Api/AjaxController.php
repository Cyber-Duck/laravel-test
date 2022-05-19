<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CalculateCostRequest;
use App\Jobs\CalculateSellingPrice;
use App\Models\CoffeeType;

class AjaxController extends Controller
{
    public function calculateCost(CoffeeType $coffeeType, CalculateCostRequest $request)
    {
        return response()->json(
            dispatch_sync(new CalculateSellingPrice($coffeeType, $request['quantity'], $request['unit_price']))
        );
    }
}
