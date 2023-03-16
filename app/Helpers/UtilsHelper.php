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
        $newcontent = str_replace("&nbsp;", "", $newcontent);
        return $newcontent;
    }

    public static function isUrl($text)
    {
        if (filter_var($text, FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }

    public static function responseAttrEncrypt($attr)
    {
        if (config('app.env') == "local") {
            return $attr;
        }
        return encrypt($attr);
    }

    public static function requestAttrEncrypt($attr)
    {
        if (config('app.env') == "local") {
            return $attr;
        }
        return decrypt($attr);
    }
}
