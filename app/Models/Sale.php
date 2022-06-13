<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'unit_cost',
        'selling_price',
    ];

    /**
     * Records a sale
     * @param  int    $quantity
     * @param  float  $unitCost
     * @param  float  $sellingPrice
     * @return Sale
     */
    public static function recordSale(int $quantity, float $unitCost, float $sellingPrice): Sale
    {
        return self::create([
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'selling_price' => $sellingPrice,
        ]);
    }
}
