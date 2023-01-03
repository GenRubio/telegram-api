<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\PaymentController;
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
    Route::prefix('payment')->group(function () {
        Route::get('/{reference}', [PaymentController::class, 'payment'])
            ->name('payment');
        Route::prefix('stripe')->group(function () {
            Route::get('success/{reference}', [StripeController::class, 'paymentSuccess'])
                ->name('stripe.payment.success');
            Route::get('cancel/{reference}', [StripeController::class, 'paymentError'])
                ->name('stripe.payment.cancel');
        });
        Route::prefix('paypal')->group(function () {
            Route::get('success/{reference}', [PaypalController::class, 'paymentSuccess'])
                ->name('paypal.payment.success');
            Route::get('cancel/{reference}', [PaypalController::class, 'paymentError'])
                ->name('paypal.payment.cancel');
        });
    });
});
