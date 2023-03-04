<?php

namespace App\Tasks\Bot;

use Exception;
use App\Tasks\GetApiClientTask;
use App\Services\BotChatService;
use Illuminate\Support\Facades\Log;
use App\Tasks\Bot\Traits\BotTasksTrait;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;
use App\Tasks\API\Translations\ButtonShopTextTask;
use App\Tasks\Bot\Settings\SetPinStartMessageTask;

class SendStartMessageTask
{
    use BotTasksTrait;

    private $chat;
    private $botChat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $clientApiUrl;
    private $message;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->botChat = (new BotChatService())->getByChatId($this->chat->chat_id);
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1672042240.2779';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->clientApiUrl = (new GetApiClientTask())->products($this->chat->chat_id);
        $this->message = $this->telegramBotMessage->getLangMessage($this->botChat->language->abbr);
    }

    public function run()
    {
        try {
            $this->chat->action(ChatActions::TYPING)->send();
            $response = $this->chat;
            if (!empty($this->telegramBotMessage->image) && !$this->telegramBotMessage->image_bottom) {
                $response = $response->photo(public_path($this->telegramBotMessage->image));
            }
            Log::error($this->clientApiUrl);
            $response = $response->html($this->getResponseText())
                //->keyboard(function (Keyboard $keyboard) {
                //    return $keyboard->row([
                //        Button::make((new ButtonShopTextTask($this->botChat))->run())
                //            ->webApp($this->clientApiUrl)
                //    ]);
                //})
                ->protected()
                ->send();
            (new SetPinStartMessageTask($this->chat, $response->telegraphMessageId()))->run();
        } catch (Exception $e) {
            Log::channel('telegram-message')->error($e);
        }
    }

    private function getResponseText()
    {
        if (!empty($this->telegramBotMessage->image) && $this->telegramBotMessage->image_bottom) {
            return $this->message . '<a href="' . url($this->telegramBotMessage->image) . '">&#8205;</a>';
        }
        return $this->message;
    }
}
