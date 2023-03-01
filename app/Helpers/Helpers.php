<?php

use App\Helpers\ApiHelper;
use App\Helpers\AuthHelper;
use App\Helpers\CrudHelper;
use App\Helpers\CacheHelper;
use App\Helpers\UtilsHelper;
use App\Helpers\SettingsHelper;
use App\Helpers\FrontJsonHelper;
use App\Helpers\BotMessagesTranslationsHelper;

if (!function_exists('clearCache')) {
    function clearCache()
    {
        return CacheHelper::clearCache();
    }
}

/**
 * AuthHelper
 */

if (!function_exists('isAdmin')) {
    function isAdmin($user = null)
    {
        return AuthHelper::isAdmin($user);
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin($user = null)
    {
        return AuthHelper::isSuperAdmin($user);
    }
}

if (!function_exists('isAdminOrSuperadmin')) {
    function isAdminOrSuperadmin($user = null)
    {
        return AuthHelper::isAdminOrSuperadmin($user);
    }
}

if (!function_exists('userIsActive')) {
    function userIsActive($user)
    {
        return AuthHelper::userIsActive($user);
    }
}

if (!function_exists('getUser')) {
    function getUser()
    {
        return AuthHelper::getUser();
    }
}


/**
 * UtilsHelper
 */

if (!function_exists('refactorBitMap')) {
    function refactorBitMap($map)
    {
        return UtilsHelper::refactorBitMap($map);
    }
}

if (!function_exists('translateText')) {
    function translateText($abbr, $attribute)
    {
        return UtilsHelper::translateText($abbr, $attribute);
    }
}

if (!function_exists('isUrl')) {
    function isUrl($text)
    {
        return UtilsHelper::isUrl($text);
    }
}

if (!function_exists('responseAttrEncrypt')) {
    function responseAttrEncrypt($attr)
    {
        return UtilsHelper::responseAttrEncrypt($attr);
    }
}

if (!function_exists('requestAttrEncrypt')) {
    function requestAttrEncrypt($attr)
    {
        return UtilsHelper::requestAttrEncrypt($attr);
    }
}

/**
 * CrudHelper
 */


if (!function_exists('toggleField')) {
    function toggleField($request)
    {
        return CrudHelper::toggleField($request);
    }
}

if (!function_exists('toggleFieldV2')) {
    function toggleFieldV2($request)
    {
        return CrudHelper::toggleFieldV2($request);
    }
}

if (!function_exists('webHookToggle')) {
    function webHookToggle($request)
    {
        return CrudHelper::webHookToggle($request);
    }
}

/**
 * SettingsHelper
 */

if (!function_exists('settings')) {
    function settings($key)
    {
        return SettingsHelper::settings($key);
    }
}

/**
 * FrontJsonHelper
 */

if (!function_exists('getJsonFirstLevelAttribute')) {
    function getJsonFirstLevelAttribute($requestAll, $key, $array = false, $date = false)
    {
        return FrontJsonHelper::getJsonFirstLevelAttribute($requestAll, $key, $array, $date);
    }
}

if (!function_exists('getJsonSecondLevelAttribute')) {
    function getJsonSecondLevelAttribute($requestAll, $key, $secondKey, $array = false, $date = false)
    {
        return FrontJsonHelper::getJsonSecondLevelAttribute($requestAll, $key, $secondKey, $array, $date);
    }
}

if (!function_exists('getJsonThirdLevelAttribute')) {
    function getJsonThirdLevelAttribute($requestAll, $key, $secondKey, $thirdKey, $array = false, $date = false)
    {
        return FrontJsonHelper::getJsonThirdLevelAttribute($requestAll, $key, $secondKey, $thirdKey, $array, $date);
    }
}

if (!function_exists('getJsonMetaValues')) {
    function getJsonMetaValues($request)
    {
        return FrontJsonHelper::getJsonMetaValues($request);
    }
}

if (!function_exists('getJsonDataValues')) {
    function getJsonDataValues($request)
    {
        return FrontJsonHelper::getJsonDataValues($request);
    }
}

if (!function_exists('getJsonValues')) {
    function getJsonValues($request)
    {
        return FrontJsonHelper::getJsonValues($request);
    }
}


/**
 * ApiHelper
 */

if (!function_exists('getAgentIp')) {
    function getAgentIp()
    {
        return ApiHelper::getAgentIp();
    }
}
