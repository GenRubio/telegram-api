<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\GetProductsController;

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

Route::get('webapp/{chat}', function () {
    return view('webapp.index');
})->name('webapp');


Route::prefix('api')->group(function () {
    Route::get('products', [GetProductsController::class, 'index']);
    Route::post('new-order', [OrderController::class, 'createOrder']);
});
