<?php

namespace App\Tasks\Bot;

use Exception;
use App\Tasks\GetApiClientTask;
use Illuminate\Support\Facades\Log;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Tasks\API\Translations\ButtonShopTextTask;

class SendGlobalMessageTask
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function run()
    {
        foreach ($this->message->telegramBotGroup->bots as $bot) {
            foreach ($bot->telegramChats as $chat) {
                try {
                    $langMessage = $this->message->getLangMessage($chat->language->abbr);
                    $clientApiUrl = (new GetApiClientTask())->products($chat->chat_id);
                    $this->sendMessageToChat($chat, $langMessage, $clientApiUrl);
                } catch (Exception $e) {
                    Log::channel('bot-message')->error($e);
                }
            }
        }
    }

    private function sendMessageToChat($chat, $langMessage, $clientApiUrl)
    {
        try {
            $response = $chat->telegraphChat;
            if (!empty($this->message->image) && !$this->message->image_bottom) {
                $response = $response->photo(public_path($this->message->image));
            }
            $response = $response->html($this->getResponseText($langMessage))
                ->keyboard(function (Keyboard $keyboard) use ($clientApiUrl, $chat) {
                    return $keyboard->row([
                        Button::make((new ButtonShopTextTask($chat))->run())
                            ->webApp($clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
        } catch (Exception $e) {
            Log::channel('telegram-message')->error($e);
        }
    }

    private function getResponseText($langMessage)
    {
        if (!empty($this->message->image) && $this->message->image_bottom) {
            return $langMessage . '<a href="' . url($this->message->image) . '">&#8205;</a>';
        }
        return $langMessage;
    }
}
