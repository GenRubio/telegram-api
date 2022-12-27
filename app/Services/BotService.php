<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Repositories\Bot\BotRepository;
use App\Repositories\Bot\BotRepositoryInterface;

/**
 * Class BotService
 * @package App\Services\Bot
 */
class BotService extends Controller
{
    private $botRepository;

    /**
     * BotService constructor.
     * @param Bot $bot
     * @param BotRepositoryInterface $botRepository
     */
    public function __construct()
    {
        $this->botRepository = new BotRepository();
    }

    public function getById($id)
    {
        return $this->botRepository->getById($id);
    }
}
