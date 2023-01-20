<?php

namespace App\Http\Resources\Api;

use App\Services\SettingService;
use App\Services\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;

class GetConfigResource extends JsonResource
{
    private $translationService;
    private $translations;
    private $language;
    private $settingService;
    private $settings;

    public function __construct($chat)
    {
        $this->translationService = new TranslationService();
        $this->translations = $this->translationService->getAll();
        $this->language = $chat->language->abbr;
        $this->settingService = new SettingService();
        $this->settings = $this->settingService->getAll();
    }

    public function toArray($request)
    {
        $response = [];
        $response['translations'] = $this->getPreparedTranslations();
        $response['settings'] = $this->getPreparedSettings();
        return $response;
    }

    private function getPreparedTranslations()
    {
        $translations = [];
        foreach ($this->translations as $translation) {
            $translations[$translation->uuid] = $this->formatLangText($translation->uuid, $translation->langText($this->language));
        }
        return $translations;
    }

    private function getPreparedSettings()
    {
        $settings = [];
        foreach ($this->settings as $setting) {
            $settings["{$setting->key}a"] = $setting->value;
        }
        return $settings;
    }

    private function formatLangText($uuid, $text)
    {
        $formattedText = $text;
        switch ($uuid) {
            case '1671778172.297963a54f7c48b8b':
                $price = $this->settings->where('key', '1671891736.2341')->first()->value;
                $formattedText = str_replace("<price>", $price, $formattedText);
                break;
        }
        return $formattedText;
    }
}
