<?php

namespace App\Services\Translations;

use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use App\Models\Translations\WEBTranslation;
use App\Repositories\Translation\WEBTranslation\WEBTranslationRepository;
use App\Repositories\Translation\WEBTranslation\WEBTranslationRepositoryInterface;

/**
 * Class WEBTranslationService
 * @package App\Services\WEBTranslation
 */
class WEBTranslationService extends TranslationService
{
    private $translationRepository;

    /**
     * WEBTranslationService constructor.
     * @param WEBTranslation $WEBTranslation
     * @param WEBTranslationRepositoryInterface $WEBTranslationRepository
     */
    public function __construct()
    {
        parent::__construct();
        $this->translationRepository = new WEBTranslationRepository();
    }
}
