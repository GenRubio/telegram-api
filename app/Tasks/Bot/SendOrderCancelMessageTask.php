<?php

namespace App\Tasks\Bot;

use App\Services\TelegramBotMessageService;

class SendOrderCancelMessageTask
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
        $this->key = '1672062409.0611';
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
        $this->message = str_replace("<reference>", $this->order->reference, $this->message);
        $this->message = str_replace("<detail>", $this->order->order_cancel_detail, $this->message);
    }
}
