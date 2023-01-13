<?php

namespace App\Http\Webhooks\Bot\v1\Bot;

trait ActionBuyProduct
{
    public function actionBuyProduct()
    {
        $this->reply("notification dismissed");
    }
}
