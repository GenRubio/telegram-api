<?php

namespace App\Tasks\Bot\Translations;

use App\Services\BotTranslationService;

class BotTranslationMessage4Task
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
        $this->key = '1673327120.3528';
        $this->botTranslation = (new BotTranslationService())->getByKey($this->key);
        $this->message = $this->botTranslation->langText($this->bot->language->abbr);
        $this->updateMessage();
    }

    public function run()
    {
        return $this->message;
    }

    private function updateMessage()
    {
        $this->message = str_replace("[product_name]", $this->data['product_name'], $this->message);
    }
}
