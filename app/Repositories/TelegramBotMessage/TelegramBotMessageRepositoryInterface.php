<?php

namespace App\Repositories\TelegramBotMessage;

/**
 * Interface TelegramBotMessageRepositoryInterface
 * @package App\Repositories\TelegramBotMessage
 */
interface TelegramBotMessageRepositoryInterface
{
    public function getByKey($key);
}
