<?php

namespace App\Contracts;

/**
     * Calculate the selling price of the coffee product.
     *
     * @param int $quantity The quantity of coffee bags.
     * @param float $unitCost The unit cost of each coffee bag.
     * @return array The calculated data
*/
interface CoffeePriceCalculator{
    public function calculateSellingPrice(int $quantity, float $unitCost): array;
}