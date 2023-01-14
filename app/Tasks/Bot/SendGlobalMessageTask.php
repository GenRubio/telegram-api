<?php

namespace App\Tasks\Bot;

use Exception;
use App\Tasks\GetApiClientTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Tasks\Bot\Translations\ButtonShopTextTask;

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
            foreach ($bot->botChat as $chat) {
                try {
                    $langMessage = $this->message->getLangMessage($chat->language->abbr);
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
                ->telegramChats
                ->photo(public_path($this->message->image))
                ->html($langMessage)
                ->keyboard(function (Keyboard $keyboard) use ($clientApiUrl, $chat) {
                    return $keyboard->row([
                        Button::make((new ButtonShopTextTask($chat))->run())
                            ->webApp($clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
        } else {
            $chat
                ->telegramChats
                ->html($langMessage)
                ->keyboard(function (Keyboard $keyboard) use ($clientApiUrl, $chat) {
                    return $keyboard->row([
                        Button::make((new ButtonShopTextTask($chat))->run())
                            ->webApp($clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
        }
    }
}
