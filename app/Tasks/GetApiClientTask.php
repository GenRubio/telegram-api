<?php

namespace App\Tasks;

use App\Services\ApiClientService;
use Illuminate\Support\Facades\Log;

class GetApiClientTask
{
    private $apiClientService;
    private $activeClients;
    private $client;

    public function __construct()
    {
        $this->apiClientService = new ApiClientService();
        $this->activeClients = $this->apiClientService->getOnline();
        $this->client = $this->activeClients->first();
    }

    public function products($chatId)
    {
        return $this->client->referer . 'webapp/' . responseAttrEncrypt($chatId);
    }
}
