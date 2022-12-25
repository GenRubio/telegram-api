<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SendErrorMessageTask
{
    private $chatId;
    private $message;
    private $chat;

    public function __construct($chatId, $message)
    {
        $this->chatId = $chatId;
        $this->message = $message;
        $this->chat = $this->setChat();
    }

    public function run()
    {
        $this->chat->html($this->message)
            ->protected()
            ->send();
    }

    private function setChat()
    {
        return TelegraphChat::where('chat_id', $this->chatId)->first();
    }
}
