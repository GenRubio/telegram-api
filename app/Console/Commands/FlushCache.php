<?php

namespace App\Console\Commands;

use App\Http\Controllers\Commands\CacheController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FlushCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flush:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Laravel cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        (new CacheController)->flushCache();
        Log::channel('cron')->info("Cache cleared successfully");
        $this->info("Cache cleared successfully");
    }
}
