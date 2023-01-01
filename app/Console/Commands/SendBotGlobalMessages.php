<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Enums\BotGlobalMessagesEnum;
use App\Tasks\Bot\SendGlobalMessageTask;
use App\Services\TelegramBotGlobalMessageService;

class SendBotGlobalMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:bot-global-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $telegramBotGlobalMessageService = new TelegramBotGlobalMessageService();
        $pendingSend = $telegramBotGlobalMessageService
            ->getPendingSend(BotGlobalMessagesEnum::STATUS_IDS['pd_sent']);
        foreach ($pendingSend as $message) {
            (new SendGlobalMessageTask($message))->run();
            $telegramBotGlobalMessageService
                ->updateStatus($message->id, BotGlobalMessagesEnum::STATUS_IDS['sent']);
        }
    }
}
