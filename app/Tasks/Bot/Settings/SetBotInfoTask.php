<?php

namespace App\Tasks\Bot\Settings;

use App\Services\BotChatService;

class SetBotInfoTask
{
    private $chat;
    private $botChat;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
    }

    public function run()
    {
        $this->chat->setTitle("Hola")->send();
    }

}
