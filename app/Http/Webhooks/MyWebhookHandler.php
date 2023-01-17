<?php

namespace App\Http\Webhooks;

use App\Services\BotChatService;
use App\Services\LanguageService;
use App\Tasks\Bot\SendStartMessageTask;
use App\Tasks\Bot\SendLanguageMessageTask;
use DefStudio\Telegraph\Enums\ChatActions;
use App\Tasks\Bot\Chat\SetReferenceChatTask;
use App\Tasks\Bot\SendNewLanguageMessageTask;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    public function start($reference = null)
    {
        $this->chat->action(ChatActions::TYPING)->send();
        $botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        if ($botChat->language) {
            (new SendStartMessageTask($this->chat))->run();
        } else {
            (new SendLanguageMessageTask($this->chat))->run();
        }
        (new SetReferenceChatTask($botChat, $reference))->run();
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
