<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    /*
    * AJAX
    */
    /* Toggle Active */
    Route::post('toggleField', function (Illuminate\Http\Request $request) {
        return toggleField($request);
    })->name('toggleField');

    Route::crud('product-model', 'ProductModelCrudController');
    Route::group(['prefix' => 'product-model/{product_model_id}'], function () {
        Route::crud('product-models-flavor', 'ProductModelsFlavorCrudController');
    });
    Route::crud('order', 'OrderCrudController');
    Route::group(['prefix' => 'order/{order_id}'], function () {
        Route::crud('order-product', 'OrderProductCrudController');
    });
    Route::crud('brand', 'BrandCrudController');
    Route::crud('api-client', 'ApiClientCrudController');
    Route::crud('language', 'LanguageCrudController');
    Route::crud('translation', 'TranslationCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('setting', 'SettingCrudController');
    Route::crud('telegram-bot-message', 'TelegramBotMessageCrudController');
    Route::crud('bot', 'BotCrudController');
}); // this should be the absolute last line of this file