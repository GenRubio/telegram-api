<?php

namespace App\Http\Webhooks\Bot\v2\Bot;

trait ActionSetLanguage
{
    public function actionSetLaguage()
    {
        $parameter = $this->data->get('parameter');
    }
}
