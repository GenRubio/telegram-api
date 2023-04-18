<?php

namespace App\Http\Resources\Api\Config;

use App\Services\SettingService;
use App\Services\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationsConfigResource extends JsonResource
{
    private $language;
    private $translationService;
    private $translations;
    private $settingService;
    private $settings;

    public function __construct($language)
    {
        $this->language = $language;
        $this->translationService = new TranslationService();
        $this->translations = $this->translationService->getAll();
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->translations as $translation) {
            $response[$translation->uuid] = $this->formatLangText($translation->uuid, $translation->langText($this->language));
        }
        return $response;
    }

    private function formatLangText($uuid, $text)
    {
        $formattedText = $text;
        switch ($uuid) {
            case 'bca7fd48-3024-49d0-adfa-6265fb745d52':
                $this->settingService = new SettingService();
                $this->settings = $this->settingService->getAll();
                $price = $this->settings->where('key', '1671891736.2341')->first()->value;
                $formattedText = str_replace("[min_order_price]", $price, $formattedText);
                break;
        }
        return $formattedText;
    }
}
