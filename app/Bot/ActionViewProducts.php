<?php

namespace App\Bot;

use App\Models\ProductModel;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionViewProducts
{
    public function actionViewProducts()
    {
        $products = ProductModel::active()->get();
        foreach ($products as $product) {
            $this->chat->html(view('components.bot.product-item', ['product' => $product])->render())
                ->keyboard(function (Keyboard $keyboard) use ($product) {
                    return $keyboard->row([
                        Button::make('👀 Ver Detalle')->action('actionViewProductDetail')->param('parameter', $product->reference),
                        Button::make('🛍️ Comprar')->action('actionBuyProduct')->param('parameter', $product->reference),
                        Button::make('🛒 Añadir al carrito')->action('actionAddProductToTrolley')->param('parameter', $product->reference),
                    ]);
                })
                ->send();
        }
    }
}
