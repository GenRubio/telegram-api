<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendPaymentUrlMessageTask
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
        $this->key = '1672062515.7575';
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
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('Pagar')->url($this->getPaymentUrl())
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $this->order->telegraphChat
                ->html($this->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('Pagar')->url($this->getPaymentUrl())
                    ]);
                })
                ->protected()
                ->send();
        }
    }

    private function getPaymentUrl()
    {
        $paymentUrl = route('stripe.payment', ['reference' => encrypt($this->order->reference)]);
        if ($this->order->payment_method == 'stripe') {
            $paymentUrl = route('stripe.payment', ['reference' => encrypt($this->order->reference)]);
        }
        return $paymentUrl;
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
