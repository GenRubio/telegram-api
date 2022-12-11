<?php

namespace App\Bot;

use App\Utils\UserTrolleyUtil;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionMyTrolleyManager
{
    public function actionMyTrolleyManager()
    {
        $productsData = UserTrolleyUtil::getProducts($this->chat->chat_id);
        if (count($productsData)) {
            $totalProducts = count($productsData);
            $text = "Actualmente tienes (<b>{$totalProducts}</b>) productos en carrito\nQue deseas hacer?";
            $this->chat->html($text)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard
                        ->button('💳 Tramitar')
                        ->action('actionShowMyTrolley')
                        ->width(0.3)
                        ->button('👀 Productos')
                        ->action('actionShowMyTrolley')
                        ->width(0.3)
                        ->button('📋 Menu')
                        ->action('actionShowMenu')
                        ->width(0.3);
                })
                ->protected()
                ->send();
        } else {
            $this->chat->html('Tu carrito esta vacio 😔')
                ->protected()
                ->send();
            $this->actionShowMenu();
        }
    }
}
