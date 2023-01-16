<?php

namespace App\Tasks\Bot\Traits;

trait BotTasksTrait
{
    public function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}