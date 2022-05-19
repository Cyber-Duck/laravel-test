<?php

use App\Http\Controllers\Web\CoffeeSaleController;
use App\Http\Controllers\Web\ShippingCostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/dashboard', '/sales');

Route::prefix('sales')->middleware(['auth'])->group(function () {
    Route::get('', [CoffeeSaleController::class, 'index'])->name('coffee.sales');
    Route::post('', [CoffeeSaleController::class, 'create'])->name('coffee.sales.create');
});

Route::prefix('shipping-partners')->middleware(['auth'])->group(function () {
    Route::get('', [ShippingCostController::class, 'index'])->name('shipping.costs');
    Route::post('', [ShippingCostController::class, 'create'])->name('shipping.cost.create');
});

require __DIR__ . '/auth.php';
