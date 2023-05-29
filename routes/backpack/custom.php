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
    Route::post('toggleFieldV2', function (Illuminate\Http\Request $request) {
        return toggleFieldV2($request);
    })->name('toggleFieldV2');
    Route::post('updateOrder', function (Illuminate\Http\Request $request) {
        return updateOrder($request);
    })->name('updateOrder');

    /*************************************************************************************** */

    Route::crud('product-model', 'ProductModelCrudController');
    Route::group(['prefix' => 'product-model/{product_model_id}'], function () {
        Route::crud('product-models-flavor', 'ProductModelsFlavorCrudController');
        Route::crud('product-model-valoration', 'ProductModelValorationCrudController');
        Route::crud('gallery-product', 'GalleryProductCrudController');
        Route::get('duplicate', 'ProductModelCrudController@duplicate');
    });
    Route::crud('order', 'OrderCrudController');
    Route::group(['prefix' => 'order/{order_id}'], function () {
        Route::crud('order-product', 'OrderProductCrudController');
    });
    Route::crud('brand', 'BrandCrudController');
    Route::crud('api-client', 'ApiClientCrudController');
    Route::get('language/texts/{lang?}/{file?}', 'LanguageCrudController@showTexts');
    Route::post('language/texts/{lang}/{file}', 'LanguageCrudController@updateTexts');
    Route::post('language/create/file', 'LanguageCrudController@createFile');
    Route::post('language/create/translation', 'LanguageCrudController@createTranslation');
    Route::post('language/square/translation', 'LanguageCrudController@squareTranslation');
    Route::crud('language', 'LanguageCrudController');
    Route::crud('translation', 'TranslationCrudController');
    Route::crud('setting', 'SettingCrudController');
    Route::crud('telegram-bot-message', 'TelegramBotMessageCrudController');
    Route::crud('bot', 'TelegraphBotCrudController');
    Route::group(['prefix' => 'bot/{bot_id}'], function () {
        Route::crud('telegraph-chat', 'TelegraphChatCrudController');
        Route::crud('telegram-bot-command', 'TelegramBotCommandCrudController');
    });
    Route::post('bot-update-webhook', 'BotCrudController@updateWebhook')
        ->name('updateWebhookBot');
    Route::post('bot-remove-webhook', 'BotCrudController@removeWebhook')
        ->name('removeWebhookBot');
    Route::post('webHookToggle', function (Illuminate\Http\Request $request) {
        return webHookToggle($request);
    })->name('webHookToggle');
    Route::crud('user', 'UserCrudController');
    Route::crud('office-permission', 'OfficePermissionCrudController');
    Route::crud('telegram-bot-global-message', 'TelegramBotGlobalMessageCrudController');
    Route::crud('telegram-bot-group', 'TelegramBotGroupCrudController');
    Route::crud('geocoding-api', 'GeocodingApiCrudController');
    Route::crud('affiliate', 'AffiliateCrudController');
    Route::crud('parametric-table', 'ParametricTableCrudController');
    Route::group(['prefix' => 'parametric-table/{parametric_table_id}'], function () {
        Route::crud('parametric-table-value', 'ParametricTableValueCrudController');
    });
    Route::crud('settings-table', 'SettingsTableCrudController');
    Route::crud('social-networks-table', 'SocialNetworksTableCrudController');
    Route::crud('payment-platform-key', 'PaymentPlatformKeyCrudController');
}); // this should be the absolute last line of this file