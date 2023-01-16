<?php

namespace App\Tasks\Bot;

use App\Tasks\GetApiClientTask;
use App\Tasks\Bot\Traits\BotTasksTrait;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use App\Tasks\Bot\Translations\ButtonOrderDetailTextTask;

class SendOrderDeliveredMessageTask
{
    use BotTasksTrait;
    
    private $order;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $message;

    public function __construct($order)
    {
        $this->order = $order;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672062437.1043';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage($this->order->botChat->language->abbr);
        $this->preparedMessage();
    }

    public function run()
    {
        $this->order->telegraphChat->action(ChatActions::TYPING)->send();
        $response = $this->order->telegraphChat;
        if (!empty($this->telegramBotMessage->image)) {
            $response = $response->photo(public_path($this->telegramBotMessage->image));
        }
        $response = $response->html($this->message)
            ->keyboard(function (Keyboard $keyboard) {
                return $keyboard->row([
                    Button::make((new ButtonOrderDetailTextTask($this->order->botChat))->run())
                        ->webApp((new GetApiClientTask())->orderDetail($this->order->reference))
                ]);
            })
            ->protected()
            ->send();
    }

    private function preparedMessage()
    {
        $this->message = str_replace("[reference]", $this->order->reference, $this->message);
    }
}
