<?php

namespace App\Tasks\Bot\Translations;

use App\Services\Translations\APITranslationService;

class FlavorNotAvailableTextTask
{
    private $chat;
    private $data;
    private $apiTranslationService;
    private $uuid;
    private $translation;
    private $message;

    public function __construct($chat, $data)
    {
        $this->chat = $chat;
        $this->data = $data;
        $this->apiTranslationService = new APITranslationService();
        $this->uuid = '212db24a-32b2-4b07-8d1b-6d5a2d4bf20d';
        $this->translation = $this->setTranslation();
        $this->message = $this->translation->langText($this->chat->language->abbr);
        $this->preparedMessage();
    }

    public function run()
    {
        return $this->message;
    }

    private function setTranslation()
    {
        return $this->apiTranslationService->getByKey($this->uuid);
    }

    private function preparedMessage()
    {
        $this->message = str_replace("[flavor_name]", $this->data['flavor_name'], $this->message);
        $this->message = str_replace("[product_name]", $this->data['product_name'], $this->message);
    }
}
