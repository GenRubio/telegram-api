<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;

class ProductNotAvailableTextTask
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
        $this->uuid = 'dacf7cf6-654e-4d17-948f-60db82c8a6e0';
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
        $this->message = str_replace("[product_name]", $this->data['product_name'], $this->message);
    }
}
