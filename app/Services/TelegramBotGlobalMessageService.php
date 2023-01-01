<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\TelegramBotGlobalMessage;
use App\Repositories\TelegramBotGlobalMessage\TelegramBotGlobalMessageRepository;
use App\Repositories\TelegramBotGlobalMessage\TelegramBotGlobalMessageRepositoryInterface;

/**
 * Class TelegramBotGlobalMessageService
 * @package App\Services\TelegramBotGlobalMessage
 */
class TelegramBotGlobalMessageService extends Controller
{
    private $telegrambotglobalmessageRepository;

    /**
     * TelegramBotGlobalMessageService constructor.
     * @param TelegramBotGlobalMessage $telegrambotglobalmessage
     * @param TelegramBotGlobalMessageRepositoryInterface $telegrambotglobalmessageRepository
     */
    public function __construct()
    {
        $this->telegrambotglobalmessageRepository = new TelegramBotGlobalMessageRepository();
    }

    public function getByStatus($status)
    {
        return $this->telegrambotglobalmessageRepository->getByStatus($status);
    }

    public function getPendingSend($status)
    {
        return $this->telegrambotglobalmessageRepository->getPendingSend($status);
    }

    public function updateStatus($id, $status)
    {
        $this->telegrambotglobalmessageRepository->updateStatus($id, $status);
    }
}
