<?php

namespace App\Http\Webhooks\Bot\v1\Bot;

use App\Utils\UserTrolleyUtil;
use Illuminate\Support\Facades\Storage;
use DefStudio\Telegraph\Keyboard\Keyboard;

trait ActionDeleteMyTrolleyProduct
{
    public function actionDeleteMyTrolleyProduct()
    {
        $parameter = $this->data->get('parameter');
        $productExist = UserTrolleyUtil::productInTrolley($this->chat->chat_id, $parameter);
        if ($productExist) {
            $disk = Storage::disk('users_trolley');
            $fileName = "{$this->chat->chat_id}.json";
            if ($disk->exists($fileName)) {
                $data = json_decode($disk->get($fileName));
                $data->products = array_diff($data->products, array($parameter));
                UserTrolleyUtil::updateProducts($this->chat->chat_id, $data->products);
                $this->actionMyTrolleyManager();
            } else {
                $this->reply("Ha ocurrido un error");
            }
        } else {
            $this->reply("Ha ocurrido un error");
        }
    }
}
