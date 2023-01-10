<?php

namespace App\Tasks\Bot\Translations;

use App\Services\BotTranslationService;

class BotTranslationMessage5Task
{
    private $bot;
    private $data;
    private $key;
    private $botTranslation;
    private $message;

    public function __construct($bot, $data)
    {
        $this->bot = $bot;
        $this->data = $data;
        $this->key = '1673327054.2177';
        $this->botTranslation = (new BotTranslationService())->getByKey($this->key);
        $this->message = $this->botTranslation->langText($this->bot->language->abbr);
    }

    public function run()
    {
        return $this->message;
    }
}
