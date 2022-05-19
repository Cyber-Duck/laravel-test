<?php

namespace App\Http\Transformers;

use App\Models\Sale;
use League\Fractal\TransformerAbstract;

class SaleTransformer extends TransformerAbstract
{
    public function transform(Sale $sale)
    {
        return [
            'product' => $sale->coffeeType->name,
            'quantity' => $sale->quantity,
            'unit_price' => $sale->unit_price,
            'selling_price' => $sale->selling_price,
            'sold_at' => $sale->created_at,
            'shipping_cost' => $sale->shipmentCost->cost
        ];
    }
}
