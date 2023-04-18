<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;

class StockNotAvailableTextTask
{
    private $telegraphChat;
    private $data;
    private $apiTranslationService;
    private $uuid;
    private $translation;
    private $message;

    public function __construct($telegraphChat, $data)
    {
        $this->telegraphChat = $telegraphChat;
        $this->data = $data;
        $this->apiTranslationService = new APITranslationService();
        $this->uuid = 'f04273a9-e0c5-4816-9bf5-cb8b0b85ea3a';
        $this->translation = $this->setTranslation();
        $this->message = $this->translation->langText($this->telegraphChat->language->abbr);
        $this->preparedMessage();
    }

    public function run()
    {
        return $this->message;
    }

    private function setTranslation()
    {
        return $this->apiTranslationService->getByUUID($this->uuid);
    }

    private function preparedMessage()
    {
        $this->message = str_replace("[flavor_name]", $this->data['flavor_name'], $this->message);
        $this->message = str_replace("[product_name]", $this->data['product_name'], $this->message);
        $this->message = str_replace("[flavor_available_stock]", $this->data['flavor_available_stock'], $this->message);
    }
}
