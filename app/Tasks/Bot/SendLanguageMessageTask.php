<?php

namespace App\Tasks\Bot;

use App\Services\LanguageService;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendLanguageMessageTask
{
    private $chat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $languages;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1673632039.8107';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->languages = (new LanguageService())->getAllActive();
    }

    public function run()
    {
        $this->chat
            ->html($this->telegramBotMessage->getLangMessage("en"))
            ->keyboard(function (Keyboard $keyboard) {
                foreach ($this->languages as $language) {
                    $keyboard
                        ->button($language->native)
                        ->action('actionSetLaguage')
                        ->param('parameter', $language->id);
                }
                return $keyboard;
            })
            ->protected()
            ->send();
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
