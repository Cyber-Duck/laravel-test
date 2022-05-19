<?php

namespace App\Http\Transformers;

use App\Models\ShippingCost;
use League\Fractal\TransformerAbstract;

class ShipmentCostTransformer extends TransformerAbstract
{
    public function transform(ShippingCost $cost)
    {
        return [
            'cost' => $cost->cost,
            'active' => $cost->active ? 'Yes' : 'No',
            'set_at' => $cost->created_at,
            'sale_count' => $cost->sales->count(),
        ];
    }
}
