<?php

namespace App\Http\Resources\Api\Config;

use App\Services\SettingService;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsConfigResource extends JsonResource
{
    private $settingService;
    private $settings;

    public function __construct()
    {
        $this->settingService = new SettingService();
        $this->settings = $this->settingService->getAll();
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->settings as $setting) {
            $response["{$setting->key}a"] = $setting->value;
        }
        return $response;
    }
}
