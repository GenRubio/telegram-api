<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\BotTranslation;
use App\Repositories\BotTranslation\BotTranslationRepository;
use App\Repositories\BotTranslation\BotTranslationRepositoryInterface;

/**
 * Class BotTranslationService
 * @package App\Services\BotTranslation
 */
class BotTranslationService extends Controller
{
    private $bottranslationRepository;

    /**
     * BotTranslationService constructor.
     * @param BotTranslation $bottranslation
     * @param BotTranslationRepositoryInterface $bottranslationRepository
     */
    public function __construct()
    {
        $this->bottranslationRepository = new BotTranslationRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
