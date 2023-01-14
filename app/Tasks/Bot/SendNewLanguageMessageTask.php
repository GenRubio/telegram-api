<?php

namespace App\Tasks\Bot;

use App\Services\BotChatService;
use App\Services\LanguageService;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendNewLanguageMessageTask
{
    private $chat;
    private $botChat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $languages;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1673688714.9174';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->languages = (new LanguageService())->getAllActive();
    }

    public function run()
    {
        $this->chat
            ->html($this->telegramBotMessage->getLangMessage($this->botChat->language->abbr))
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
