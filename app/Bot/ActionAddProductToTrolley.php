<?php

namespace App\Bot;

use Exception;
use Illuminate\Support\Facades\Storage;

trait ActionAddProductToTrolley
{
    public function actionAddProductToTrolley()
    {
        try {
            $success = false;
            $parameter = $this->data->get('parameter');
            $disk = Storage::disk('users_trolley');
            $fileName = "{$this->chat->chat_id}.json";
            if ($disk->exists($fileName)) {
                $data = json_decode($disk->get($fileName));
                if (!in_array($parameter, $data->products)) {
                    $data->products[] = $parameter;
                    $disk->put($fileName, json_encode($data));
                    $success = true;
                }
            } else {
                $disk->put($fileName, json_encode([
                    'products' => [
                        $parameter
                    ]
                ]));
                $success = true;
            }
            if ($success) {
                $newKeyboard = $this->originalKeyboard
                    ->deleteButton('🛒 Añadir al carrito');
                $this->replaceKeyboard($newKeyboard);
                $this->reply("Producto se ha añadido al carrito correctamente");
            } else {
                $this->reply("Este producto ya esta en tu carrito");
            }
        } catch (Exception $e) {
            $this->reply("Ha ocurrido un error");
        }
    }
}
