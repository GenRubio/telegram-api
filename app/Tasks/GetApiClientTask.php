<?php

namespace App\Tasks;

use App\Services\ApiClientService;

class GetApiClientTask
{
    private $chatId;
    private $apiClientService;
    private $activeClients;

    public function __construct($chatId)
    {
        $this->chatId = $chatId;
        $this->apiClientService = new ApiClientService();
        $this->activeClients = $this->apiClientService->getAll();
    }

    public function run()
    {
        return $this->activeClients->first()->url . 'webapp/' . $this->chatId;
    }
}
