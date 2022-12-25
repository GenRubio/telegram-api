<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SendErrorPaymentMessageTask
{
    private $order;
    private $customer;
    private $chat;

    public function __construct($order)
    {
        $this->order = $order;
        $this->customer = $this->order->customer;
        $this->chat = $this->setChat();
    }

    public function run()
    {
        $this->chat->html("El pedido fue cancelado")
            ->protected()
            ->send();
    }

    private function setChat()
    {
        return TelegraphChat::where('chat_id', $this->customer->chat_id)->first();
    }
}
