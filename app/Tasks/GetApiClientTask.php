<?php

namespace App\Tasks;

use App\Services\ApiClientService;
use Illuminate\Support\Facades\Log;

class GetApiClientTask
{
    private $apiClientService;
    private $activeClients;

    public function __construct()
    {
        $this->apiClientService = new ApiClientService();
        $this->activeClients = $this->apiClientService->getOnline();
    }

    public function products($chatId)
    {
        Log::error($this->activeClients->first()->referer);
        return $this->activeClients->first()->referer . 'webapp/' . responseAttrEncrypt($chatId);
    }

    public function orderDetail($reference)
    {
        //return $this->activeClients->first()->url . 'order/' . $reference;
    }
}
