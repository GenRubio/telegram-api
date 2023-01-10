<?php

namespace App\Helpers;

use App\Services\SettingService;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    public static function settings($key)
    {
        $settingService = new SettingService();
        return $settingService->getByKey($key)->value;
    }
}
