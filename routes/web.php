<?php

use App\Http\Controllers\CoffeeSalesController;
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
    return redirect()->route('login');
});
Route::controller(CoffeeSalesController::class)->group(function () {
    Route::get('/salesdashboard', 'dashboard')->name('dashboard');
    Route::get('/salesdashboard2', 'dashboard2')->name('dashboard2');
    Route::post('/newsale', 'newsale')->name('newsale');
    Route::post('/newsale1', 'newsale1')->name('newsale1');
});
Route::redirect('/dashboard', '/sales');

Route::get('/sales', function () {
    return view('coffee_sales');
})->middleware(['auth'])->name('coffee.sales');

Route::get('/shipping-partners', function () {
    return view('shipping_partners');
})->middleware(['auth'])->name('shipping.partners');

require __DIR__.'/auth.php';
