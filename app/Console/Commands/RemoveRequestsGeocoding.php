<?php

namespace App\Console\Commands;

use App\Models\GeocodingApi;
use Illuminate\Console\Command;
use App\Services\GeocodingApiService;

class RemoveRequestsGeocoding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:requests-geocoding';

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
        GeocodingApi::query()->update(['requests' => 0]);
    }
}
