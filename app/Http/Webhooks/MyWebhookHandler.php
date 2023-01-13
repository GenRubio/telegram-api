<?php

namespace App\Http\Webhooks;

use Exception;
use App\Models\BotChat;
use App\Services\BotChatService;
use App\Tasks\Bot\SendStartMessageTask;
use DefStudio\Telegraph\Keyboard\Button;
use App\Tasks\Bot\SendLanguageMessageTask;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use App\Http\Webhooks\Bot\v2\Bot\ActionSetLanguage;

class MyWebhookHandler extends WebhookHandler
{
    use ActionSetLanguage;

    //$reference = null
    public function start()
    {
        $botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        if ($botChat->language) {
            $this->chat
                ->html("test")
                ->protected()
                ->send();
            //(new SendStartMessageTask($this->chat))->run();
        } else {
            $this->chat
                ->html("hola")
                ->protected()
                ->send();
            //(new SendLanguageMessageTask($this->chat))->run();
        }
        //https://t.me/HQDTiendaProdEsBot?start=3245435
        //try {
        //    BotChat::where('chat_id', $this->chat->chat_id)
        //        ->update([
        //            'reference' => $reference
        //        ]);
        //} catch (Exception $e) {
        //}
    }
}
