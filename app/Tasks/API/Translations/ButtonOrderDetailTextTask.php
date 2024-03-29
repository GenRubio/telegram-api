<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;


class ButtonOrderDetailTextTask
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
        $this->uuid = '8afca38c-d9b6-44a6-8d1e-5dda28f0c6ab';
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
