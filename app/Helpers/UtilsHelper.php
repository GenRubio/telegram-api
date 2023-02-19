<?php

namespace App\Helpers;

use App\Services\LanguageService;

class UtilsHelper
{
    public static function refactorBitMap($map)
    {
        $refactor = str_replace(' ', '', $map);
        return str_replace("\n", "\r\n", $refactor);
    }

    public static function translateText($abbr, $attribute)
    {
        $language = (new LanguageService())->getByAbbr($abbr);
        $message = json_decode($attribute)->{$language->abbr};
        $newcontent = preg_replace("/<p[^>]*?>/", "", $message);
        $newcontent = str_replace("</p>", "\n", $newcontent);
        $newcontent = preg_replace("/<span[^>]*?>/", "", $newcontent);
        $newcontent = str_replace("</span>", "", $newcontent);
        $newcontent = preg_replace("/<br[^>]*?>/", "", $newcontent);
        $newcontent = str_replace("</br>", "", $newcontent);
        return $newcontent;
    }
}
