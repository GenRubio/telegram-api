<?php

namespace App\Tasks\Bot;

use App\Services\TelegramBotMessageService;

class SendPaymentUrlCancelMessageTask
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
        $this->key = '1672899914.5809';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->botId = $this->order->telegraphChat->bot->id;
        $this->message = $this->telegramBotMessage->getLangMessage($this->botId);
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
}