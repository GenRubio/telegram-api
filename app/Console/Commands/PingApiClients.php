<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiClientService;

class PingApiClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ping:api-clients';

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
        $apiClientService = new ApiClientService();
        $apiClients = $apiClientService->getToPing();
        foreach ($apiClients as $client) {
            $response = $this->ping($client->domain);
            if ($response['health'] == 301 && $response['status'] == 1) {
                $apiClientService->setOnline($client->id, true);
            } else {
                $apiClientService->setOnline($client->id, false);
            }
        }
    }

    private function ping($server)
    {
        $port = '80';
        $url = $server . ':' . $port;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($health) {
            return ['health' => $health, 'status' => '1'];
        } else {
            return ['health' => $health, 'status' => '0'];
        }
    }
}
