<?php

namespace App\Tasks\Bot\Settings;

class SetCommandsBotTask
{
    private $bot;
    private $telegraphBot;

    public function __construct($bot)
    {
        $this->bot = $bot;
        $this->telegraphBot = $this->bot->telegraphBot;
    }

    public function run()
    {
        $this->telegraphBot->unregisterCommands();
        $commandsData = [];
        foreach ($this->bot->telegramBotCommands as $command) {
            $commandsData[] = [
                $command->command => $command->description
            ];
        }
        $this->telegraphBot->registerCommands($commandsData)
            ->send();
    }
}
