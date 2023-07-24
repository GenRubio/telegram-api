<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestMaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:maps';

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
        $addressEndoded = urlencode("Madrid, España");
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $addressEndoded . "&key=";

        $opts = array(
            'http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-Length: 0'
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);

        $json = json_decode($result);
        dd($json);
    }
}
