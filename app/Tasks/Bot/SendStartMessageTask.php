<?php

namespace App\Tasks\Bot;

use Exception;
use App\Tasks\GetApiClientTask;
use App\Services\BotChatService;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use App\Tasks\Bot\Settings\SetPinStartMessageTask;
use App\Tasks\Bot\Translations\ButtonShopTextTask;

class SendStartMessageTask
{
    private $chat;
    private $botChat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $clientApiUrl;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672042240.2779';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->clientApiUrl = (new GetApiClientTask())->products($this->chat->chat_id);
    }

    public function run()
    {
        $response = $this->chat;
        if (!empty($this->telegramBotMessage->image)) {
            $response = $response->photo(public_path($this->telegramBotMessage->image));
        }
        $response = $response->html($this->telegramBotMessage->getLangMessage($this->botChat->language->abbr))
            ->keyboard(function (Keyboard $keyboard) {
                return $keyboard->row([
                    Button::make((new ButtonShopTextTask($this->botChat))->run())
                        ->webApp($this->clientApiUrl)
                ]);
            })
            ->protected()
            ->send();
        (new SetPinStartMessageTask($this->chat, $response->telegraphMessageId()))->run();
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
