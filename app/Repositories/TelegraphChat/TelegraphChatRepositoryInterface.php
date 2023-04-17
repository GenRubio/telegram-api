<?php

namespace App\Repositories\TelegraphChat;

/**
 * Interface TelegraphChatRepositoryInterface
 * @package App\Repositories\TelegraphChat
 */
interface TelegraphChatRepositoryInterface
{
    public function getByChatId($id);
    public function update($chatId, $data);
}
