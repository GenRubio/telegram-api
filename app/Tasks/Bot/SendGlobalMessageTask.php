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
        foreach ($this->message->telegramBotGroup->telegraphBots as $telegraphBot) {
            foreach ($telegraphBot->telegraphChats as $telegraphChat) {
                try {
                    $langMessage = $this->message->getLangMessage($telegraphChat->language->abbr);
                    $clientApiUrl = (new GetApiClientTask())->products($telegraphChat->chat_id);
                    $this->sendMessageToChat($telegraphChat, $langMessage, $clientApiUrl);
                } catch (Exception $e) {
                    Log::channel('bot-message')->error($e);
                }
            }
        }
    }

    private function sendMessageToChat($telegraphChat, $langMessage, $clientApiUrl)
    {
        try {
            $response = $telegraphChat;
            if (!empty($this->message->image) && !$this->message->image_bottom) {
                $response = $response->photo(public_path($this->message->image));
            }
            $response = $response->html($this->getResponseText($langMessage))
                ->keyboard(function (Keyboard $keyboard) use ($clientApiUrl, $telegraphChat) {
                    return $keyboard->row([
                        Button::make((new ButtonShopTextTask($telegraphChat))->run())
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
