<?php

namespace App\Bot;

use Illuminate\Support\Facades\Storage;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionViewProductDetail
{
    public function actionViewProductDetail()
    {
        $parameter = $this->data->get('parameter');
        $disk = Storage::disk('database_json');
        $data = json_decode($disk->get('products.json'));
        foreach ($data->products as $product) {
            if ($product->reference == $parameter) {
                $this->chat->html(view('components.bot.product-description', ['product' => $product])->render())
                    ->keyboard(function (Keyboard $keyboard) use ($product) {
                        return $keyboard->row([
                            Button::make('🛍️ Comprar')->action('actionBuyProduct')->param('parameter', $product->reference),
                            Button::make('🛒 Añadir al carrito')->action('actionAddProductToTrolley')->param('parameter', $product->reference),
                        ])->row([
                            Button::make('📋 Menu')->action('actionShowMenu')->param('parameter', $product->reference),
                        ]);
                    })
                    ->send();
            }
        }
    }
}
