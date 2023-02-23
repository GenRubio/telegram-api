<?php

namespace App\Repositories\Translation;

/**
 * Interface TranslationRepositoryInterface
 * @package App\Repositories\Translation
 */
interface TranslationRepositoryInterface
{
    public function getAll();
    public function getByUUID($uuid);
}
