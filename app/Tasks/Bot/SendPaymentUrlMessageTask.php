<?php

namespace App\Tasks\Bot;

use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SendPaymentUrlMessageTask
{
    private $order;
    private $customer;
    private $chat;

    public function __construct($order, $customer)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->chat = $this->setChat();
    }

    public function run()
    {
        $paymentUrl = route('stripe.payment', ['reference' => encrypt($this->order->reference)]);
        if ($this->order->payment_method == 'stripe') {
            $paymentUrl = route('stripe.payment', ['reference' => encrypt($this->order->reference)]);
        }
        $this->chat->html("Gracias por realizar pedido.\nAccede al siguente enlce para realizar el pago.\nRequerda que este enlace tiene una validez de 10 minutos")
            ->keyboard(function (Keyboard $keyboard) use ($paymentUrl) {
                return $keyboard->row([
                    Button::make('Pagar')->url($paymentUrl)
                ]);
            })
            ->protected()
            ->send();
    }

    private function setChat()
    {
        return TelegraphChat::where('chat_id', $this->customer->chat_id)->first();
    }
}
