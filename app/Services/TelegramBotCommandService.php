<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\TelegramBotCommand;
use App\Repositories\TelegramBotCommand\TelegramBotCommandRepository;
use App\Repositories\TelegramBotCommand\TelegramBotCommandRepositoryInterface;

/**
 * Class TelegramBotCommandService
 * @package App\Services\TelegramBotCommand
 */
class TelegramBotCommandService extends Controller
{
    private $telegrambotcommandRepository;

    /**
     * TelegramBotCommandService constructor.
     * @param TelegramBotCommand $telegrambotcommand
     * @param TelegramBotCommandRepositoryInterface $telegrambotcommandRepository
     */
    public function __construct()
    {
        $this->telegrambotcommandRepository = new TelegramBotCommandRepository();
    }

    public function getAll()
    {
        return $this->telegrambotcommandRepository->getAll();
    }
}
