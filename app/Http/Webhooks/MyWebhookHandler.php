<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    //https://defstudio.github.io/telegraph/quickstart/setting-webhook
    //https://dashboard.ngrok.com/get-started/your-authtoken
    //https://github.com/defstudio/telegraph/discussions/119#discussioncomment-3162578
    //ngrok http http://127.0.0.1:8000
    //protected function handleChatMessage(Stringable $text): void
    //{
    //    $this->chat->html("Received: $text")->send();
    //}

    public function patata(): void
    {
        $this->chat->html("Hola mundo")->send();
    }

    public function formulario(): void
    {
        $this->chat->html('<input type="text" name="name">')->send();
    }
}
