<?php

namespace App\Tasks\Bot\Translations;

use App\Services\Translations\APITranslationService;

class AddressNotFoundTextTask
{
    private $chat;
    private $apiTranslationService;
    private $uuid;
    private $translation;
    private $message;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->apiTranslationService = new APITranslationService();
        $this->uuid = '1673327054.2177';
        $this->translation = $this->setTranslation();
        $this->message = $this->translation->langText($this->chat->language->abbr);
    }

    public function run()
    {
        return $this->message;
    }

    private function setTranslation()
    {
        return $this->apiTranslationService->getByKey($this->uuid);
    }
}
