<?php

namespace App\Bot;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionShowMenu
{
    public function actionShowMenu()
    {
        $this->chat->html(view('components.bot.menu')->render())
            ->keyboard(function (Keyboard $keyboard) {
                return $keyboard->row([
                    Button::make('Catalago')->action('actionViewProducts'),
                    Button::make('Productos')->action('actionViewProducts'),
                    Button::make('Mi Carrito')->action('actionViewProducts'),
                ]);
            })
            ->send();
    }
}
