<?php

namespace App\Tasks\Bot\Settings;

use App\Services\BotChatService;

class SetPinStartMessageTask
{
    private $chat;
    private $messageId;
    private $botChatService;
    private $botChat;

    public function __construct($chat, $messageId)
    {
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->botChatService = new BotChatService();
        $this->botChat = $this->botChatService->getByChatId($this->chat->chat_id);
    }

    public function run()
    {
        if ($this->botChat->pin_message) {
            $this->chat->unpinAllMessages();
        }
        $this->chat->pinMessage($this->messageId)->send();
        $this->botChatService->update($this->chat->chat_id, [
            'pin_message' => $this->messageId
        ]);
    }
}
