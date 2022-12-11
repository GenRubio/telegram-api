<?php

namespace App\v1\Bot;

use App\Models\ProductModel;
use App\Utils\UserTrolleyUtil;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionViewProducts
{
    public function actionViewProducts()
    {
        $products = ProductModel::active()->get();
        foreach ($products as $product) {
            $productInTrolley = UserTrolleyUtil::productInTrolley($this->chat->chat_id, $product->reference);
            $this->chat->html(view('components.bot.product-item', ['product' => $product])->render())
                ->keyboard(function (Keyboard $keyboard) use ($product, $productInTrolley) {
                    return $keyboard
                        ->when(!$productInTrolley, function (Keyboard $keyboard) use ($product) {
                            return $keyboard->button('🛍️ Comprar')
                                ->action('actionBuyProduct')
                                ->param('parameter', $product->reference)
                                ->width(0.3)
                                ->button('👀 Ver Detalle')
                                ->action('actionViewProductDetail')
                                ->param('parameter', $product->reference)
                                ->width(0.3)
                                ->button('🛒 Añadir al carrito')
                                ->action('actionAddProductToTrolley')
                                ->param('parameter', $product->reference)
                                ->width(0.3);
                        })
                        ->when($productInTrolley, function (Keyboard $keyboard) use ($product) {
                            return $keyboard->button('🛍️ Comprar')
                                ->action('actionBuyProduct')
                                ->param('parameter', $product->reference)
                                ->width(0.5)
                                ->button('👀 Ver Detalle')
                                ->action('actionViewProductDetail')
                                ->param('parameter', $product->reference)
                                ->width(0.5);
                        });
                })
                ->protected()
                ->send();
        }
    }
}
