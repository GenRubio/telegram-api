<?php

namespace App\Tasks\Bot;

use App\Tasks\Order\GetPaymentUrlTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendPaymentUrlMessageTask
{
    private $order;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $message;
    private $paymentUrl;

    public function __construct($order)
    {
        $this->order = $order;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672062515.7575';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage($this->order->telegraphChat->language->abbr);
        $this->paymentUrl = (new GetPaymentUrlTask($this->order))->run();
    }

    public function run()
    {
        if (!empty($this->telegramBotMessage->image)) {
            $this->order->telegraphChat
                ->photo(public_path($this->telegramBotMessage->image))
                ->html($this->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('Pagar')->url($this->paymentUrl)
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $this->order->telegraphChat
                ->html($this->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('Pagar')->url($this->paymentUrl)
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
