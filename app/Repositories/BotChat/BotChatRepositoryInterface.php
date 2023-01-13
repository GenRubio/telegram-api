<?php

namespace App\Repositories\BotChat;

/**
 * Interface BotChatRepositoryInterface
 * @package App\Repositories\BotChat
 */
interface BotChatRepositoryInterface
{
    public function getByChatId($id);
}
