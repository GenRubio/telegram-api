<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;

class ErrorTextTask
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
        $this->uuid = '7075c037-add7-4f5e-909e-41e38eadfe82';
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
