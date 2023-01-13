<?php

namespace App\Http\Webhooks;

use App\Models\BotChat;
use App\Tasks\Bot\SendStartMessageTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Exception;

class MyWebhookHandler extends WebhookHandler
{
    public function start($reference = null)
    {
        //https://t.me/HQDTiendaProdEsBot?start=3245435
        try{
            BotChat::where('chat_id', $this->chat->chat_id)
            ->update([
                'reference' => $reference
            ]);
        }
        catch(Exception $e){

        }
        (new SendStartMessageTask($this->chat))->run();
    }
}
