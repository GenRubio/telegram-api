<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\TelegraphBot;
use App\Repositories\TelegraphBot\TelegraphBotRepository;
use App\Repositories\TelegraphBot\TelegraphBotRepositoryInterface;

/**
 * Class TelegraphBotService
 * @package App\Services\TelegraphBot
 */
class TelegraphBotService extends Controller
{
    private $telegraphBotRepository;

    /**
     * TelegraphBotService constructor.
     * @param TelegraphBot $TelegraphBot
     * @param TelegraphBotRepositoryInterface $TelegraphBotRepository
     */
    public function __construct()
    {
        $this->telegraphBotRepository = new TelegraphBotRepository();
    }

    public function getById($id)
    {
        return $this->telegraphBotRepository->getById($id);
    }
}
