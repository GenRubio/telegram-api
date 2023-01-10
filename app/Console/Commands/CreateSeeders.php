<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

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
        $disk = Storage::disk('laravel');
        $route = 'database/seeders';
        $files = $disk->allFiles($route);
        $deleteFiles = [];
        foreach($files as $file){
            if (!str_contains($file, 'DatabaseSeeder')){
                $deleteFiles[] = $file;
            }
        }
        $disk->delete($deleteFiles);
        foreach($this->getTables() as $table){
            Artisan::call("iseed {$table}");
            dump("{$table} --> created");
        }
    }

    private function getTables()
    {
        return [
            'brands',
            'telegraph_bots',
            'product_models',
            'product_models_flavors',
            'users',
            'languages',
            'translations',
            'settings',
            'telegram_bot_messages',
            'office_permissions',
            'user_office_permissions',
            'telegram_bot_groups',
            'telegram_bot_group_bot',
            'api_clients',
            'bot_translations',
            'geocoding_apis'
        ];
    }
}
