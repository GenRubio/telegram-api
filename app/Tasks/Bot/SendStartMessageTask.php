<?php

namespace App\Tasks\Bot;

use App\Services\TelegramBotMessageService;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SendStartMessageTask
{
    private $chat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672042240.2779';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
    }

    public function run()
    {
        if (!empty($this->telegramBotMessage->image)) {
            $this->chat
                ->photo(public_path($this->telegramBotMessage->image))
                ->html($this->telegramBotMessage->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('Productos')->webApp(route('webapp', ['chat' => $this->chat->chat_id]))
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $this->chat
                ->html($this->telegramBotMessage->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('Productos')->webApp(route('webapp', ['chat' => $this->chat->chat_id]))
                    ]);
                })
                ->protected()
                ->send();
        }
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
