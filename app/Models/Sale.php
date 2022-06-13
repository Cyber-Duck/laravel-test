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
        'shipping_id',
        'selling_price',
    ];

    /**
     * Defines the belongs to relationship to products
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Records a sale
     * @param  int    $productId
     * @param  int    $quantity
     * @param  float  $unitCost
     * @param  float  $sellingPrice
     * @return Sale
     */
    public static function recordSale(int $productId, int $quantity, float $unitCost, float $sellingPrice): Sale
    {
        $product = Product::firstOrFail();

        $shippingId = Shipping::getId();

        return $product->sales()->create([
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'shipping_id' => $shippingId,
            'selling_price' => $sellingPrice,
        ]);
    }

    /**
     * Defines the belongs to relationship to shippings
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
}
