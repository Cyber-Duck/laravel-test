<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CoffeeType;
use App\Models\Sale;

class CoffeeSaleController extends Controller
{
    public function index()
    {
        $coffeeTypes = CoffeeType::all();
        $sales = Sale::all();

        return view(
            'coffee_sales',
            [
                'coffeeTypeOptions' => $coffeeTypes->mapWithKeys(fn($type) => [$type->id => $type->name]),
                'sales' => [],
            ]
        );
    }

    public function create()
    {
        dd("here");
    }
}
