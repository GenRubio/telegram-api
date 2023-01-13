<?php

namespace App\Tasks\Bot;

use App\Services\TelegramBotMessageService;

class SendOrderSentMessageTask
{
    private $order;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $message;

    public function __construct($order)
    {
        $this->order = $order;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672062424.6009';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage($this->order->telegraphChat->language->abbr);
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
        $this->message = str_replace("[reference]", $this->order->reference, $this->message);
    }
}
