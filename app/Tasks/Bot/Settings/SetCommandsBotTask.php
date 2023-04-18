<?php

namespace App\Tasks\Bot\Settings;

class SetCommandsBotTask
{
    private $telegraphBot;

    public function __construct($telegraphBot)
    {
        $this->telegraphBot = $telegraphBot;
    }

    public function run()
    {
        $this->telegraphBot->unregisterCommands();
        $commandsData = [];
        foreach ($this->telegraphBot->telegramBotCommands as $command) {
            $commandsData[$command->command] = $command->description;
        }
        $this->telegraphBot->registerCommands($commandsData)
            ->send();
    }
}
