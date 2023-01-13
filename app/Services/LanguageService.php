<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Language\LanguageRepositoryInterface;

/**
 * Class LanguageService
 * @package App\Services\Language
 */
class LanguageService extends Controller
{
    private $languageRepository;

    /**
     * LanguageService constructor.
     * @param Language $language
     * @param LanguageRepositoryInterface $languageRepository
     */
    public function __construct()
    {
        $this->languageRepository = new LanguageRepository();
    }

    public function getAllActive()
    {
        return $this->languageRepository->getAllActive();
    }

    public function getById($id)
    {
        return $this->languageRepository->getById($id);
    }

    public function getByAbbr($abbr)
    {
        return $this->languageRepository->getByAbbr($abbr);
    }
}
