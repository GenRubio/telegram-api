<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;

class GenericTextTask
{
    private $telegraphChat;
    private $apiTranslationService;
    private $uuid;
    private $translation;
    private $message;

    public function __construct($telegraphChat, $uuid)
    {
        $this->telegraphChat = $telegraphChat;
        $this->apiTranslationService = new APITranslationService();
        $this->uuid = $uuid;
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
