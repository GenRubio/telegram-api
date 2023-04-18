<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;

class CreateOrderErrorTextTask
{
    private $telegraphChat;
    private $apiTranslationService;
    private $uuid;
    private $translation;
    private $message;

    public function __construct($telegraphChat)
    {
        $this->telegraphChat = $telegraphChat;
        $this->apiTranslationService = new APITranslationService();
        $this->uuid = '59c90a7e-304e-4b28-968d-864e74f9747f';
        $this->translation = $this->setTranslation();
        $this->message = $this->translation->langText($this->telegraphChat->language->abbr);
    }

    public function run()
    {
        return $this->message;
    }

    private function setTranslation()
    {
        return $this->apiTranslationService->getByUUID($this->uuid);
    }
}
