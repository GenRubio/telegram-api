<?php

namespace App\Repositories\BotTranslation;

/**
 * Interface BotTranslationRepositoryInterface
 * @package App\Repositories\BotTranslation
 */
interface BotTranslationRepositoryInterface
{
    public function getByKey($key);
}
