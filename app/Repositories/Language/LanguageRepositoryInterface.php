<?php

namespace App\Repositories\Language;

/**
 * Interface LanguageRepositoryInterface
 * @package App\Repositories\Language
 */
interface LanguageRepositoryInterface
{
    public function getAllActive();
    public function getById($id);
    public function getByAbbr($abbr);
}
