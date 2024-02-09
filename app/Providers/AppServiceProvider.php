<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CoffeePriceCalculator;
use App\Services\GoldCoffeePrice;
use App\Services\ArabicCoffeePrice;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CoffeePriceCalculator::class, GoldCoffeePrice::class);
        $this->app->bind(CoffeePriceCalculator::class, ArabicCoffeePrice::class);
        $this->app->bind(CoffeeController::class, CoffeePriceCalculator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
