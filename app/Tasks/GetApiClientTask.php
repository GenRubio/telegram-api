<?php

namespace App\Tasks;

use App\Services\ApiClientService;

class GetApiClientTask
{
    private $apiClientService;
    private $activeClients;

    public function __construct()
    {
        $this->apiClientService = new ApiClientService();
        $this->activeClients = $this->apiClientService->getAll();
    }

    public function products($chatId)
    {
        return $this->activeClients->first()->referer . 'webapp/' . responseAttrEncrypt($chatId);
    }

    public function orderDetail($reference)
    {
        //return $this->activeClients->first()->url . 'order/' . $reference;
    }
}
