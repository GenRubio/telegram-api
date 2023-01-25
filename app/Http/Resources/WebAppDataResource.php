<?php

namespace App\Http\Resources;

use App\Services\BotService;
use App\Services\SettingService;
use App\Services\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;

class WebAppDataResource extends JsonResource
{
    private $products;
    private $translationService;
    private $translations;
    private $language;
    private $settingService;
    private $settings;

    public function __construct($products, $chat)
    {
        $this->products = $products;
        $this->translationService = new TranslationService();
        $this->translations = $this->translationService->getAll();
        $this->language = $chat->language->abbr;
        $this->settingService = new SettingService();
        $this->settings = $this->settingService->getAll();
    }

    public function toArray($request)
    {
        $response = [];
        $response['products'] = $this->getPreparedProducts();
        $response['translations'] = $this->getPreparedTranslations();
        $response['settings'] = $this->getPreparedSettings();
        return $response;
    }

    private function getPreparedProducts()
    {
        $products = [];
        foreach ($this->products as $product) {
            $productData = $this->getProductData($product);
            $productData['flavors'] = [
                'data' => $this->getFlavorsData($product)
            ];
            $products[] = $productData;
        }
        return $products;
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

    private function getProductData($product)
    {
        return [
            'reference' => $product->reference,
            'name' => $product->name,
            'image' => url($product->image),
            'price' => $product->price,
            'discount' => $product->discount,
            'price_with_discount' => $product->price_with_discount,
            'brand' => $product->productBrand->name,
            'description' => [
                'data' => [
                    [
                        'name' => $this->getTranslationByUuid('1671777986.996363a54ec2f33a9'),
                        'value' => $product->concentration,
                        'simbol' => 'mg/ml',
                        'image' => url('images/icons/bg3-1.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778008.413463a54ed864ef9'),
                        'value' => $product->absorbable_quantity,
                        'simbol' => 'Puffs',
                        'image' => url('images/icons/bg3-2.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778015.547363a54edf859bd'),
                        'value' => $product->size,
                        'simbol' => 'mm',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778023.580863a54ee78dca6'),
                        'value' => $product->power_range,
                        'simbol' => 'W',
                        'has_images' => false
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778039.236463a54ef739b80'),
                        'value' => $product->battery_capacity,
                        'simbol' => 'mAh',
                        'image' => url('images/icons/bg3-4.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778050.365463a54f025935e'),
                        'value' => $product->e_liquid_capacity,
                        'simbol' => 'ml',
                        'image' => url('images/icons/bg3-5.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778059.778763a54f0bbe1a1'),
                        'value' => $product->resistance,
                        'simbol' => 'Ω',
                        'image' => url('images/icons/bg3-6.png'),
                        'has_images' => true
                    ],
                    [
                        'name' => $this->getTranslationByUuid('1671778073.652763a54f199f58d'),
                        'value' => $product->charging_port,
                        'simbol' => null,
                        'image' => url('images/icons/bg3-3.png'),
                        'has_images' => true
                    ]
                ]
            ]
        ];
    }

    private function getFlavorsData($product)
    {
        $flavors = [];
        foreach ($product->productModelsFlavors as $flavor) {
            $flavors[] = [
                'reference' => $flavor->reference,
                'name' => $flavor->name,
                'image' => url($flavor->image),
                'stock' => $flavor->stock - $flavor->stock_bloqued,
            ];
        }
        return $flavors;
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

    private function getTranslationByUuid($uuid)
    {
        $translation = $this->translations->where('uuid', $uuid)->first();
        return $translation->langText($this->language);
    }
}
