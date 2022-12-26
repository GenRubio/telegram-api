<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\TelegramBotMessage;
use App\Repositories\TelegramBotMessage\TelegramBotMessageRepository;
use App\Repositories\TelegramBotMessage\TelegramBotMessageRepositoryInterface;

/**
 * Class TelegramBotMessageService
 * @package App\Services\TelegramBotMessage
 */
class TelegramBotMessageService extends Controller
{
    private $telegrambotmessageRepository;

    /**
     * TelegramBotMessageService constructor.
     * @param TelegramBotMessage $telegrambotmessage
     * @param TelegramBotMessageRepositoryInterface $telegrambotmessageRepository
     */
    public function __construct()
    {
        $this->telegrambotmessageRepository = new TelegramBotMessageRepository();
    }

    public function getByKey($key)
    {
        return $this->telegrambotmessageRepository->getByKey($key);
    }
}
