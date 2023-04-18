<?php

namespace App\Tasks\API\Translations;

use App\Services\Translations\APITranslationService;

class AddressNotFoundTextTask
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
        $this->uuid = '26c38ac0-dcc9-4063-95c0-b66782761b3c';
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
