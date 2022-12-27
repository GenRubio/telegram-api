<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Repositories\Translation\TranslationRepository;
use App\Repositories\Translation\TranslationRepositoryInterface;

/**
 * Class TranslationService
 * @package App\Services\Translation
 */
class TranslationService extends Controller
{
    private $translationRepository;

    /**
     * TranslationService constructor.
     * @param Translation $translation
     * @param TranslationRepositoryInterface $translationRepository
     */
    public function __construct()
    {
        $this->translationRepository = new TranslationRepository();
    }

    public function getAll()
    {
        return $this->translationRepository->getAll();
    }
}
