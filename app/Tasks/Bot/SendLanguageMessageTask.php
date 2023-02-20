<?php

namespace App\Tasks\Bot;

use Exception;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Log;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Services\TelegramBotMessageService;

class SendLanguageMessageTask
{
    private $chat;
    private $telegramBotMessageService;
    private $key;
    private $telegramBotMessage;
    private $languages;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->telegramBotMessageService = new TelegramBotMessageService();
        $this->key = '1673632039.8107';
        $this->telegramBotMessage = $this->setTelegramBotMessage();
        $this->languages = (new LanguageService())->getAllActive();
    }

    public function run()
    {
        try {
            $this->chat->action(ChatActions::TYPING)->send();
            $response = $this->chat;
            if (!empty($this->telegramBotMessage->image)) {
                $response = $response->photo(public_path($this->telegramBotMessage->image));
            }
            $response = $response->html($this->telegramBotMessage->getLangMessage("en"))
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

    private function setTelegramBotMessage()
    {
        return $this->telegramBotMessageService->getByKey($this->key);
    }
}
