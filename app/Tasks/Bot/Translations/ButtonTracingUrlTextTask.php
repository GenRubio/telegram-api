<?php

namespace App\Tasks\Bot\Translations;

use App\Services\BotTranslationService;

class ButtonTracingUrlTextTask
{
    private $chat;
    private $botTranslationService;
    private $key;
    private $botTranslation;
    private $message;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->botTranslationService = new BotTranslationService();
        $this->key = '1673781552.7086';
        $this->botTranslation = $this->setBotTranslation();
        $this->message = $this->botTranslation->langText($this->chat->language->abbr);
    }

    public function run()
    {
        return $this->message;
    }

    private function setBotTranslation()
    {
        return $this->botTranslationService->getByKey($this->key);
    }
}
