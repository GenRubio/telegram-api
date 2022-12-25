<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SendSuccessPaymentMessageTask
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
        $this->chat->html("Pago realizado correctamente.\nGracias por confiar en nosotros.\nEl numero de referencia de tu pedido es el siguente {$this->order->reference}")
            ->protected()
            ->send();
    }

    private function setChat()
    {
        return TelegraphChat::where('chat_id', $this->customer->chat_id)->first();
    }
}
