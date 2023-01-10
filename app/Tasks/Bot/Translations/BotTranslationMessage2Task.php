<?php

namespace App\Tasks\Bot\Translations;

use App\Services\BotTranslationService;

class BotTranslationMessage2Task
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
        $this->key = '1673327205.5788';
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
        $this->message = str_replace("[flavor_name]", $this->data['flavor_name'], $this->message);
        $this->message = str_replace("[product_name]", $this->data['product_name'], $this->message);
        $this->message = str_replace("[flavor_available_stock]", $this->data['flavor_available_stock'], $this->message);
    }
}
