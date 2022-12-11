<?php

namespace App\Bot;

use App\Utils\UserTrolleyUtil;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionShowMenu
{
    public function actionShowMenu()
    {
        //$productsInTrolley = UserTrolleyUtil::countProducts($this->chat->chat_id);
        //$this->chat->html(view('components.bot.menu')->render())
        //    ->keyboard(function (Keyboard $keyboard) use ($productsInTrolley) {
        //        return $keyboard->row([
        //            Button::make('Catalago')->action('actionViewProducts'),
        //            Button::make('Productos')->action('actionViewProducts'),
        //            Button::make("Mi Carrito ({$productsInTrolley})")->action('actionMyTrolleyManager'),
        //        ]);
        //    })
        //    ->protected()
        //    ->send();
        $productsInTrolley = UserTrolleyUtil::countProducts($this->chat->chat_id);
        $this->chat->html(view('components.bot.menu')->render())
            ->keyboard(function (Keyboard $keyboard) use ($productsInTrolley) {
                return $keyboard->row([
                    Button::make('Catalago')->action('actionViewProducts'),
                    Button::make('Productos')->webApp(route('telegram.web')),
                    Button::make("Mi Carrito ({$productsInTrolley})")->action('actionMyTrolleyManager'),
                ]);
            })
            ->protected()
            ->send();
    }
}
