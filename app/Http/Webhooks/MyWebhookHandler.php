<?php

namespace App\Http\Webhooks;

use Illuminate\Support\Facades\Storage;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    public function productos(): void
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

    public function producto($parameter)
    {
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
                            Button::make('📋 Menu')->action('actionBuyProduct')->param('parameter', $product->reference),
                        ]);
                    })
                    ->send();
            }
        }
    }

    public function actionViewProductDetail()
    {
        $parameter = $this->data->get('parameter');
        $this->producto($parameter);
    }

    public function actionBuyProduct()
    {
        $this->reply("notification dismissed");
    }

    public function actionAddProductToTrolley()
    {
        $newKeyboard = $this->originalKeyboard
            ->deleteButton('🛒 Añadir al carrito'); 
        $this->replaceKeyboard($newKeyboard);

        $parameter = $this->data->get('parameter');

        //$this->chat->chat_id
        // $this->reply("Este producto ya esta en carrito");
        //$this->reply("Producto se ha añadido al carrito correctamente");
    }

    public function testrespuesta()
    {
        $keyboard = ReplyKeyboard::make()
            ->button('Send Contact')->requestContact()
            ->button('Send Location')->requestLocation()
            ->inputPlaceholder("Waiting for input...");
        $this->chat->message('hello world')
            ->replyKeyboard($keyboard)->send();
    }

    public function requestContact()
    {
    }


    //public function patata(): void
    //{
    //    $this->chat->html("Hola mundo")->send();
    //}
    //
    //public function formulario(): void
    //{
    //    $this->chat->message('hello world')
    //        ->keyboard(Keyboard::make()->buttons([
    //            Button::make('Delete')->action('delete')->param('id', '42'),
    //            Button::make('open')->url('https://test.it'),
    //        ]))->send();
    //}
}
