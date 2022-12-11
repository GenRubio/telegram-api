<?php

namespace App\Bot;

use App\Models\ProductModel;
use App\Utils\UserTrolleyUtil;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionShowMyTrolley
{
    public function actionShowMyTrolley()
    {
        $productsData = UserTrolleyUtil::getProducts($this->chat->chat_id);
        if (count($productsData)) {
            $products = ProductModel::whereIn('reference', $productsData)->get();
            foreach ($products as $product) {
                $this->chat->html(view('components.bot.trolley-product', ['product' => $product])->render())
                    ->keyboard(function (Keyboard $keyboard) use ($product) {
                        return $keyboard
                            ->button('❌ Eliminar')
                            ->action('actionDeleteMyTrolleyProduct')
                            ->param('parameter', $product->reference);
                    })
                    ->protected()
                    ->send();
            }
        } else {
            $this->chat->html('Tu carrito esta vacio 😔')
                ->protected()
                ->send();
        }
    }
}
