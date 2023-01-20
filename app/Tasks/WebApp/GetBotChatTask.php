<?php

namespace App\Tasks\WebApp;

use App\Services\BotChatService;
use App\Exceptions\GenericException;

class GetBotChatTask
{
    private $chatId;
    private $botChatService;

    public function __construct($chatId)
    {
        $this->chatId = $chatId;
        $this->botChatService = new BotChatService();
    }

    public function run()
    {
        $chat = $this->botChatService->getByChatId($this->chatId);
        if (is_null($chat)) {
            throw new GenericException("Chat {$this->chatId} undefined");
        }
        return $chat;
    }
}
