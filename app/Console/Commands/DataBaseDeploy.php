<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class DataBaseDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:database';

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
        $dataBaseName = config('database.connections.mysql.database');
        DB::statement("DROP DATABASE {$dataBaseName}");
        DB::statement("CREATE DATABASE {$dataBaseName}");
        Artisan::call('migrate --seed');
    }
}
