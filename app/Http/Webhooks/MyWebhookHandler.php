<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    public function patata(): void
    {
        $this->chat->html("Hola mundo")->send();
    }

    public function formulario(): void
    {
        $this->chat->html('<input type="text" name="name">')->send();
    }
}
