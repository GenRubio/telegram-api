<?php

namespace App\Tasks\Bot\Settings;

use App\Services\TelegraphChatService;

class SetPinStartMessageTask
{
    private $telegraphChat;
    private $messageId;
    private $telegraphChatService;

    public function __construct($telegraphChat, $messageId)
    {
        $this->telegraphChat = $telegraphChat;
        $this->messageId = $messageId;
        $this->telegraphChatService = new TelegraphChatService();
    }

    public function run()
    {
        if ($this->telegraphChat->pin_message) {
            $this->telegraphChat->unpinMessage($this->telegraphChat->pin_message)->send();
            $this->telegraphChat->deleteMessage($this->telegraphChat->pin_message)->send();
        }
        $this->telegraphChat->pinMessage($this->messageId)->send();
        $this->telegraphChatService->update($this->telegraphChat->chat_id, [
            'pin_message' => $this->messageId
        ]);
    }
}
