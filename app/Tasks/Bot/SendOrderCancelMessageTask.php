<?php

namespace App\Tasks\Bot;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Tasks\Bot\Traits\BotTasksTrait;
use DefStudio\Telegraph\Enums\ChatActions;
use App\Services\TelegramBotMessageService;

class SendOrderCancelMessageTask
{
    use BotTasksTrait;

    private $order;
    private $telegraphChat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $message;

    public function __construct($order)
    {
        $this->order = $order;
        $this->telegraphChat = $this->order->telegraphChat;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672062409.0611';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage(
            $this->telegraphChat->language->abbr
        );
        $this->preparedMessage();
    }

    public function run()
    {
        try {
            $this->telegraphChat->action(ChatActions::TYPING)->send();
            $response = $this->telegraphChat;
            if (!empty($this->telegramBotMessage->image) && !$this->telegramBotMessage->image_bottom) {
                $response = $response->photo(public_path($this->telegramBotMessage->image));
            }
            $response = $response->html($this->getResponseText())
                ->protected()
                ->send();
        } catch (Exception $e) {
            Log::channel('telegram-message')->error($e);
        }
    }

    private function preparedMessage()
    {
        $this->message = str_replace("[reference]", $this->order->reference, $this->message);
        $this->message = str_replace("[detail]", $this->order->order_cancel_detail, $this->message);
    }

    private function getResponseText()
    {
        if (!empty($this->telegramBotMessage->image) && $this->telegramBotMessage->image_bottom) {
            return $this->message . '<a href="' . url($this->telegramBotMessage->image) . '">&#8205;</a>';
        }
        return $this->message;
    }
}
