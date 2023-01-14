<?php

namespace App\Tasks\Bot\Translations;

use App\Services\BotTranslationService;

class StockNotAvailableTextTask
{
    private $chat;
    private $data;
    private $botTranslationService;
    private $key;
    private $botTranslation;
    private $message;

    public function __construct($chat, $data)
    {
        $this->chat = $chat;
        $this->data = $data;
        $this->botTranslationService = new BotTranslationService();
        $this->key = '1673327205.5788';
        $this->botTranslation = $this->setBotTranslation();
        $this->message = $this->botTranslation->langText($this->chat->language->abbr);
        $this->preparedMessage();
    }

    public function run()
    {
        return $this->message;
    }

    private function setBotTranslation()
    {
        return $this->botTranslationService->getByKey($this->key);
    }

    private function preparedMessage()
    {
        $this->message = str_replace("[flavor_name]", $this->data['flavor_name'], $this->message);
        $this->message = str_replace("[product_name]", $this->data['product_name'], $this->message);
        $this->message = str_replace("[flavor_available_stock]", $this->data['flavor_available_stock'], $this->message);
    }
}
