<?php

namespace App\Repositories\TelegramBotGlobalMessage;

/**
 * Interface TelegramBotGlobalMessageRepositoryInterface
 * @package App\Repositories\TelegramBotGlobalMessage
 */
interface TelegramBotGlobalMessageRepositoryInterface
{
    public function getByStatus($status);
    public function getPendingSend($status);
    public function updateStatus($id, $status);
}
