<?php

namespace App\Http\Resources;

use App\Services\BotService;
use App\Services\SettingService;
use App\Services\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDataResource extends JsonResource
{
    private $order;
    private $bot;
    private $translationService;
    private $translations;
    private $language;
    private $settingService;
    private $settings;

    public function __construct($order)
    {
        $this->order = $order;
        $this->bot = $this->order->bot();
        $this->translationService = new TranslationService();
        $this->translations = $this->translationService->getAll();
        $this->language = $this->bot->language;
        $this->settingService = new SettingService();
        $this->settings = $this->settingService->getAll();
    }

    public function toArray($request)
    {
        $response = [];
        $response['client_token'] = $this->order->chat_id;
        $response['order'] = $this->getOrderData();
        $response['translations'] = $this->getPreparedTranslations();
        $response['settings'] = $this->getPreparedSettings();
        return $response;
    }

    private function getOrderData()
    {
        $data = [];
        $data['reference'] = $this->order->reference;
        $data['name'] = $this->order->name;
        $data['surnames'] = $this->order->surnames;
        $data['address'] = $this->order->address;
        $data['postal_code'] = $this->order->postal_code;
        $data['city'] = $this->order->city;
        $data['price'] = $this->order->price;
        $data['total_price'] = $this->order->total_price;
        $data['shipping_price'] = $this->order->shipping_price;
        $data['products'] = $this->getOrderProductsData();
        return $data;
    }

    private function getOrderProductsData()
    {
        $data = [];
        foreach ($this->order->orderProducts as $product) {
            $data[] = [
                'image' => url($product->productModelsFlavor->image),
                'model' => $product->productModel->name,
                'flavor' => $product->productModelsFlavor->name,
                'brand' => $product->productModel->productBrand->name,
                'amount' => $product->amount,
            ];
        }
        return $data;
    }

    private function getPreparedTranslations()
    {
        $translations = [];
        foreach ($this->translations as $translation) {
            $translations[$translation->uuid] = $this->formatLangText($translation->uuid, $translation->langText($this->language->abbr));
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
