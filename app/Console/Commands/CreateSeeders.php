<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateSeeders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:seeders';

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
        return Command::SUCCESS;
    }

    private function getTables()
    {
        return [
            'brands',
            'telegraph_bots',
            'telegraph_chats',
            'product_models',
            'product_models_flavors',
            'users',
            'languages',
            'translations',
            'settings',
            'telegram_bot_messages',
            'customers',
            'office_permissions',
            'user_office_permissions',
            'telegram_bot_groups',
            'telegram_bot_group_bot',
            'api_clients',
            'bot_translations'
        ];
    }
}
