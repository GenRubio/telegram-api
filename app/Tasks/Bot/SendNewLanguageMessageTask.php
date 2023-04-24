<?php

namespace App\Tasks\Bot;

use Exception;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Log;
use App\Services\TelegraphChatService;
use App\Tasks\Bot\Traits\BotTasksTrait;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendNewLanguageMessageTask
{
    use BotTasksTrait;

    private $telegraphChat;
    private $key;
    private $telegramBotMessage;
    private $languages;
    private $message;

    public function __construct($chat)
    {
        $this->telegraphChat = (new TelegraphChatService())->getByChatId($chat->chat_id);
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1673688714.9174';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->languages = (new LanguageService())->getAllActive();
        $this->message = $this->telegramBotMessage->getLangMessage(
            $this->telegraphChat->language->abbr
        );
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
                ->keyboard(function (Keyboard $keyboard) {
                    foreach ($this->languages as $language) {
                        $keyboard
                            ->button($language->native)
                            ->action('actionSetLaguage')
                            ->param('parameter', $language->id);
                    }
                    return $keyboard;
                })
                ->protected()
                ->send();
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
