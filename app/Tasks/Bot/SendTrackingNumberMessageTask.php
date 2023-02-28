<?php

namespace App\Tasks\Bot;

use Exception;
use App\Tasks\GetApiClientTask;
use Illuminate\Support\Facades\Log;
use App\Tasks\Bot\Traits\BotTasksTrait;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use App\Tasks\API\Translations\ButtonTracingUrlTextTask;
use App\Tasks\API\Translations\ButtonOrderDetailTextTask;

class SendTrackingNumberMessageTask
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
        $this->key = '1672062471.687';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->message = $this->telegramBotMessage->getLangMessage($this->order->botChat->language->abbr);
        $this->preparedMessage();
    }

    public function run()
    {
        try {
            $this->order->telegraphChat->action(ChatActions::TYPING)->send();
            $response = $this->order->telegraphChat;
            if (!empty($this->telegramBotMessage->image) && !$this->telegramBotMessage->image_bottom) {
                $response = $response->photo(public_path($this->telegramBotMessage->image));
            }
            $response = $response->html($this->getResponseText())
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make((new ButtonTracingUrlTextTask($this->order->botChat))->run())
                            ->url($this->order->provider_url),
                        //Button::make((new ButtonOrderDetailTextTask($this->order->botChat))->run())
                        //    ->webApp((new GetApiClientTask())->orderDetail($this->order->reference))
                    ]);
                })
                ->protected()
                ->send();
        } catch (Exception $e) {
            Log::channel('telegram-message')->error($e);
        }
    }

    private function preparedMessage()
    {
        $this->message = str_replace("[reference]", $this->order->reference, $this->message);
    }

    private function getResponseText()
    {
        if (!empty($this->telegramBotMessage->image) && $this->telegramBotMessage->image_bottom) {
            return $this->message . '<a href="' . url($this->telegramBotMessage->image) . '">&#8205;</a>';
        }
        return $this->message;
    }
}
