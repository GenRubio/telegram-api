<?php

namespace App\Tasks\Bot;

use App\Services\BotChatService;
use App\Tasks\GetApiClientTask;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use Exception;

class SendStartMessageTask
{
    private $chat;
    private $botChat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $clientApiUrl;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672042240.2779';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->clientApiUrl = (new GetApiClientTask($this->chat->chat_id))->run();
    }

    public function run()
    {
        if (!empty($this->telegramBotMessage->image)) {
            $response = $this->chat
                ->photo(public_path($this->telegramBotMessage->image))
                ->html($this->telegramBotMessage->getLangMessage($this->botChat->language->abbr))
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('TIENDA')->webApp($this->clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
            try{
                $data = $response->result->message_id;
                $this->chat->html("Ok")->send();
            }
            catch(Exception $e){
                //$response->result->message_id
                $this->chat->html("Error")->send();
            }

            //$this->chat->html($response->result->message_id)->send();
            //$this->chat->html($this->chat->message->id)->send();
            //$this->chat->pinMessage($chatMessage->messageId)->send();
        } else {
            $this->chat
                ->html($this->telegramBotMessage->getLangMessage($this->botChat->language->abbr))
                ->keyboard(function (Keyboard $keyboard) {
                    return $keyboard->row([
                        Button::make('TIENDA')->webApp($this->clientApiUrl)
                    ]);
                })
                ->protected()
                ->send();
            //$this->chat->pinMessage($chatMessage->messageId)->send();
        }
    }

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
