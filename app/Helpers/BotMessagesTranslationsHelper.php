<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use App\Services\BotTranslationService;

class BotMessagesTranslationsHelper
{
    public static function botMessage($bot, $key)
    {
        $botTranslation = (new BotTranslationService())->getByKey($key);
        switch ($botTranslation->key) {
            case '1673327276.5674':
                break;
            case '1673327205.5788':
                break;
            case '1673327156.0906':
                break;
            case '1673327120.3528':
                break;
            case '1673327054.2177':
                break;
            case '1673326913.3364':
                break;
            default:
               return "Error";
        }
    }
}
