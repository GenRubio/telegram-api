<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\TelegraphChat;
use App\Repositories\TelegraphChat\TelegraphChatRepository;
use App\Repositories\TelegraphChat\TelegraphChatRepositoryInterface;

/**
 * Class TelegraphChatService
 * @package App\Services\TelegraphChat
 */
class TelegraphChatService extends Controller
{
    private $telegraphChatRepository;

    /**
     * TelegraphChatService constructor.
     * @param TelegraphChat $TelegraphChat
     * @param TelegraphChatRepositoryInterface $TelegraphChatRepository
     */
    public function __construct()
    {
        $this->telegraphChatRepository = new TelegraphChatRepository();
    }

    public function getByChatId($id)
    {
        return $this->telegraphChatRepository->getByChatId($id);
    }

    public function update($chatId, $data)
    {
        $this->telegraphChatRepository->update($chatId, $data);
    }
}
