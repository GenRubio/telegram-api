<?php

namespace App\Bot;

use App\Models\ProductModel;
use App\Utils\UserTrolleyUtil;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionViewProductDetail
{
    public function actionViewProductDetail()
    {
        $parameter = $this->data->get('parameter');
        $product = ProductModel::where('reference', $parameter)
            ->active()
            ->first();

        if (is_null($product)) {
            $this->chat->html("No hemos podido localizar este producto");
        } else {
            $productInTrolley = UserTrolleyUtil::productInTrolley($this->chat->chat_id, $parameter);
            $this->chat->html(view('components.bot.product-description', ['product' => $product])->render())
                ->keyboard(function (Keyboard $keyboard) use ($product, $productInTrolley) {
                    return $keyboard
                        ->when(!$productInTrolley, function (Keyboard $keyboard) use ($product) {
                            return $keyboard->button('🛍️ Comprar')
                                ->action('actionBuyProduct')
                                ->param('parameter', $product->reference)
                                ->width(0.5)
                                ->button('🛒 Añadir al carrito')
                                ->action('actionAddProductToTrolley')
                                ->param('parameter', $product->reference)
                                ->width(0.5)
                                ->button('📋 Menu')
                                ->action('actionShowMenu');
                        })
                        ->when($productInTrolley, function (Keyboard $keyboard) use ($product) {
                            return $keyboard->button('🛍️ Comprar')
                                ->action('actionBuyProduct')
                                ->param('parameter', $product->reference)
                                ->width(0.5)
                                ->button('📋 Menu')
                                ->action('actionShowMenu')
                                ->width(0.5);
                        });
                })
                ->send();
        }
    }
}
