<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use App\Tasks\Bot\Translations\ButtonOrderDetailTextTask;

class SendSuccessPaymentMessageTask
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
        $this->key = '1672078516.7314';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage($this->order->botChat->language->abbr);
        $this->preparedMessage();
    }

    public function run()
    {
        if (!empty($this->telegramBotMessage->image)) {
            $this->order->telegraphChat
                ->photo(public_path($this->telegramBotMessage->image))
                ->html($this->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make((new ButtonOrderDetailTextTask($this->order->botChat))->run())
                            ->webApp("https://github.com/")
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $this->order->telegraphChat
                ->html($this->message)
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make((new ButtonOrderDetailTextTask($this->order->botChat))->run())
                            ->webApp("https://github.com/")
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

    private function preparedMessage()
    {
        $this->message = str_replace("[reference]", $this->order->reference, $this->message);
    }
}
