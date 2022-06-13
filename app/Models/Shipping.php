<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = ['cost'];

    /**
     * Returns the latest shipping cost
     * @return float
     */
    public static function getCost()
    {
        $shipping = self::latest()
            ->first();

        if ($shipping) {
            return $shipping->cost;
        }
    }

    /**
     * Returns the latest shipping id
     * @return int
     */
    public static function getId()
    {
        $shipping = self::latest()
            ->first();

        if ($shipping) {
            return $shipping->id;
        }
    }

    /**
     * Defines the has many relationship to sales
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
