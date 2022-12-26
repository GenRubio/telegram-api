<?php

namespace App\Http\Webhooks;

use App\Tasks\Bot\SendStartMessageTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    public function start()
    {
        (new SendStartMessageTask($this->chat))->run();
    }
}
