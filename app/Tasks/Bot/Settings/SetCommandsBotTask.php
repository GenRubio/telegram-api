<?php

namespace App\Tasks\Bot\Settings;

class SetCommandsBotTask
{
    private $chat;

    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    public function run()
    {
        $this->chat->bot->unregisterCommands();
        $this->chat->bot->registerCommands([
            'language' => 'unregisterCommands'
        ])->send();
    }

}
