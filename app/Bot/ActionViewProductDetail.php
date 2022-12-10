<?php

namespace App\Bot;

use App\Models\ProductModel;
use DefStudio\Telegraph\Keyboard\Button;
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
            $this->chat->html(view('components.bot.product-description', ['product' => $product])->render())
                ->keyboard(function (Keyboard $keyboard) use ($product) {
                    return $keyboard->row([
                        Button::make('🛍️ Comprar')->action('actionBuyProduct')->param('parameter', $product->reference),
                        Button::make('🛒 Añadir al carrito')->action('actionAddProductToTrolley')->param('parameter', $product->reference),
                    ])->row([
                        Button::make('📋 Menu')->action('actionShowMenu'),
                    ]);
                })
                ->send();
        }
    }
}
