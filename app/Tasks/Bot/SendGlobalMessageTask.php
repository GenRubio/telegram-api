<?php

namespace App\Tasks\Bot;

use Exception;
use App\Tasks\GetApiClientTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

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
            $langMessage = $this->message->getLangMessage($bot->id);
            foreach ($bot->telegramChats as $chat) {
                try {
                    $clientApiUrl = (new GetApiClientTask($chat->chat_id))->run();
                    $this->sendMessageToChat($chat, $langMessage, $clientApiUrl);
                } catch (Exception $e) {
                }
            }
        }
    }

    private function sendMessageToChat($chat, $langMessage, $clientApiUrl)
    {
        if (!empty($this->message->image)) {
            $chat
                ->photo(public_path($this->message->image))
                ->html($langMessage)
                ->keyboard(function (Keyboard $keyboard) use ($clientApiUrl) {
                    return $keyboard->row([
                        Button::make('TIENDA')->webApp($clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $chat
                ->html($langMessage)
                ->keyboard(function (Keyboard $keyboard) use ($clientApiUrl) {
                    return $keyboard->row([
                        Button::make('TIENDA')->webApp($clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
        }
    }
}
