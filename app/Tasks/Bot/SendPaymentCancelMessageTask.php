<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use App\Tasks\Bot\Translations\ButtonOrderDetailTextTask;

class SendPaymentCancelMessageTask
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
        $this->key = '1672899563.642';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage($this->order->botChat->language->abbr);
    }

    public function run()
    {
        $response = $this->order->telegraphChat;
        if (!empty($this->telegramBotMessage->image)) {
            $response = $response->photo(public_path($this->telegramBotMessage->image));
        }
        $response = $response->html($this->message)
            ->keyboard(function (Keyboard $keyboard) {
                return $keyboard->row([
                    Button::make((new ButtonOrderDetailTextTask($this->order->botChat))->run())
                        ->webApp("https://github.com/")
                ]);
            })
            ->protected()
            ->send();
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
