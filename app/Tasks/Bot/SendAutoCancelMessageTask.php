<?php

namespace App\Tasks\Bot;

use App\Services\SettingService;
use App\Services\TelegramBotMessageService;

class SendAutoCancelMessageTask
{
    private $order;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $botId;
    private $message;

    public function __construct($order)
    {
        $this->order = $order;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672062323.5633';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->botId = $this->order->telegraphChat->bot->id;
        $this->message = $this->telegramBotMessage->getLangMessage($this->botId);
        $this->preparedMessage();
    }

    public function run()
    {
        if (!empty($this->telegramBotMessage->image)) {
            $this->order->telegraphChat
                ->photo(public_path($this->telegramBotMessage->image))
                ->html($this->message)
                ->protected()
                ->send();
        } else {
            $this->order->telegraphChat
                ->html($this->message)
                ->protected()
                ->send();
        }
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }

    private function preparedMessage()
    {
        $settingService = new SettingService();
        $time = $settingService->getByKey('1671967273.4378')->value;
        $this->message = str_replace("<time>", $time, $this->message);
    }
}
