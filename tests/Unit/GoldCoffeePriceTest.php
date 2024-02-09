<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Services\GoldCoffeePrice;

class GoldCoffeePriceTest extends TestCase
{
    public function testCalculateSellingPrice1()
    {
        $adapter = new GoldCoffeePrice();

        $quantity = 5;
        $unitCost = 10.0;
        $expectedSellingPrice = 76.67; // Adjust based on your calculation logic

        $actualSellingPrice = $adapter->calculateSellingPrice($quantity, $unitCost);
        $actualSellingPrice['sellingPrice'];

        $this->assertEquals($expectedSellingPrice, $actualSellingPrice['sellingPrice']);
    }

    public function testCalculateSellingPrice2()
    {
        $adapter = new GoldCoffeePrice();

        $quantity = 5;
        $unitCost = 12.0;
        $expectedSellingPrice = 90.00; // Adjust based on your calculation logic

        $actualSellingPrice = $adapter->calculateSellingPrice($quantity, $unitCost);

        $this->assertEquals($expectedSellingPrice, $actualSellingPrice['sellingPrice']);
    }

    public function testCalculateSellingPrice3()
    {
        $adapter = new GoldCoffeePrice();

        $quantity = 2;
        $unitCost = 20.50;
        $expectedSellingPrice = 64.67; // Adjust based on your calculation logic

        $actualSellingPrice = $adapter->calculateSellingPrice($quantity, $unitCost);

        $this->assertEquals($expectedSellingPrice, $actualSellingPrice['sellingPrice']);
    }
}