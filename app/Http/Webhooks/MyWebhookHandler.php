<?php

namespace App\Http\Webhooks;

use Exception;
use App\Models\BotChat;
use App\Services\BotChatService;
use App\Services\LanguageService;
use App\Tasks\Bot\SendStartMessageTask;
use DefStudio\Telegraph\Keyboard\Button;
use App\Tasks\Bot\SendLanguageMessageTask;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Tasks\Bot\SendNewLanguageMessageTask;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    //$reference = null
    public function start($reference = null)
    {
        $botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        if ($botChat->language) {
            (new SendStartMessageTask($this->chat))->run();
        } else {
            (new SendLanguageMessageTask($this->chat))->run();
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

    public function language()
    {
        (new SendNewLanguageMessageTask($this->chat))->run();
    }

    public function actionSetLaguage()
    {
        $parameter = $this->data->get('parameter');
        $botChatService = new BotChatService();
        $language = (new LanguageService())->getById($parameter);
        if (!is_null($language)) {
            $botChatService->update($this->chat->chat_id, [
                'language_id' => $language->id
            ]);
            $this->chat->deleteMessage($this->messageId)->send();
            (new SendStartMessageTask($this->chat))->run();
        }
    }
}
