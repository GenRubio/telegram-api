<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    public function start()
    {
        $this->chat->html("Tienda")
            ->keyboard(function (Keyboard $keyboard) {
                return $keyboard->row([
                    Button::make('Productos')->webApp(route('webapp', ['chat' => $this->chat->chat_id]))
                ]);
            })
            ->protected()
            ->send();
    }
}
