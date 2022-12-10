<?php

namespace App\Bot;

trait ActionAddProductToTrolley
{
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
}
