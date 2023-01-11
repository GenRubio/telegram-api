<?php

namespace App\Tasks\Bot;

use App\Tasks\GetApiClientTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendStartMessageTask
{
    private $chat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $clientApiUrl;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672042240.2779';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->clientApiUrl = (new GetApiClientTask($this->chat->chat_id))->run();
    }

    public function run()
    {
        if (!empty($this->telegramBotMessage->image)) {
            $this->chat
                ->photo(public_path($this->telegramBotMessage->image))
                ->html($this->telegramBotMessage->getLangMessage($this->chat->bot->id))
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('TIENDA')->webApp($this->clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $this->chat
                ->html($this->telegramBotMessage->getLangMessage($this->chat->bot->id))
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('TIENDA')->webApp($this->clientApiUrl)
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
