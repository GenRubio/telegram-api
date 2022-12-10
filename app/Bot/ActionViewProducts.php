<?php

namespace App\Bot;

use Illuminate\Support\Facades\Storage;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionViewProducts
{
    public function actionViewProducts()
    {
        $disk = Storage::disk('database_json');
        $data = json_decode($disk->get('products.json'));
        foreach ($data->products as $product) {
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
