<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;

class FrontJsonHelper
{
    public static function getJsonFirstLevelAttribute($requestAll, $key, $array, $date)
    {
        if (isset($requestAll->$key) && !is_null($requestAll->$key)) {
            if ($array) {
                return (array)$requestAll->$key;
            } else {
                return $date ? new Carbon($requestAll->$key) : $requestAll->$key;
            }
        }

        return null;
    }

    public static function getJsonSecondLevelAttribute($requestAll, $key, $secondKey, $array, $date)
    {
        if (
            isset($requestAll->$key->$secondKey)
            && !is_null($requestAll->$key->$secondKey)
        ) {
            if ($array) {
                return (array)$requestAll->$key->$secondKey;
            } else {
                return $date ? new Carbon($requestAll->$key->$secondKey) : $requestAll->$key->$secondKey;
            }
        }

        return null;
    }

    public static function getJsonThirdLevelAttribute($requestAll, $key, $secondKey, $thirdKey, $array, $date)
    {
        if (
            isset($requestAll->$key->$secondKey->$thirdKey)
            && !is_null($requestAll->$key->$secondKey->$thirdKey)
        ) {
            if ($array) {
                return (array)$requestAll->$key->$secondKey->$thirdKey;
            } else {
                return $date ? new Carbon($requestAll->$key->$secondKey->$thirdKey) : $requestAll->$key->$secondKey->$thirdKey;
            }
        }

        return null;
    }

    public static function getJsonMetaValues($request)
    {
        $parameter = $request->get('_meta');
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false){
            return json_decode($parameter);
        }
        return json_decode(json_encode($parameter));
    }

    public static function getJsonDataValues($request)
    {
        $parameter = $request->get('data');
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false){
            return json_decode($parameter);
        }
        return json_decode(json_encode($parameter));
    }

    public static function getJsonValues($parameter)
    {
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false){
            return json_decode($parameter);
        }
        return json_decode(json_encode($parameter));
    }
}
