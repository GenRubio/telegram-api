<?php

namespace App\Services\Translations;

use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use App\Models\Translations\APITranslation;
use App\Repositories\Translation\APITranslation\APITranslationRepository;
use App\Repositories\Translation\APITranslation\APITranslationRepositoryInterface;

/**
 * Class APITranslationService
 * @package App\Services\APITranslation
 */
class APITranslationService extends TranslationService
{
    private $translationRepository;

    /**
     * APITranslationsService constructor.
     * @param APITranslation $APITranslation
     * @param APITranslationRepositoryInterface $APITranslationRepository
     */
    public function __construct()
    {
        parent::__construct();
        $this->translationRepository = new APITranslationRepository();
    }
}
