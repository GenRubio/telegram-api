<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\BotChat;
use App\Repositories\BotChat\BotChatRepository;
use App\Repositories\BotChat\BotChatRepositoryInterface;

/**
 * Class BotChatService
 * @package App\Services\BotChat
 */
class BotChatService extends Controller
{
    private $botchatRepository;

    /**
     * BotChatService constructor.
     * @param BotChat $botchat
     * @param BotChatRepositoryInterface $botchatRepository
     */
    public function __construct()
    {
        $this->botchatRepository = new BotChatRepository();
    }

    public function getByChatId($id)
    {
        return $this->botchatRepository->getByChatId($id);
    }

    public function update($chatId, $data)
    {
        $this->botchatRepository->update($chatId, $data);
    }
}
