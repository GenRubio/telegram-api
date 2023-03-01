<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\ApiClient;
use App\Repositories\ApiClient\ApiClientRepository;
use App\Repositories\ApiClient\ApiClientRepositoryInterface;

/**
 * Class ApiClientService
 * @package App\Services\ApiClient
 */
class ApiClientService extends Controller
{
    private $apiclientRepository;

    /**
     * ApiClientService constructor.
     * @param ApiClient $apiclient
     * @param ApiClientRepositoryInterface $apiclientRepository
     */
    public function __construct()
    {
        $this->apiclientRepository = new ApiClientRepository();
    }

    public function getAll()
    {
        return $this->apiclientRepository->getAll();
    }

    public function getOnline()
    {
        return $this->apiclientRepository->getOnline();
    }

    public function getToPing()
    {
        return $this->apiclientRepository->getToPing();
    }

    public function setOnline($id, $status)
    {
        $this->apiclientRepository->setOnline($id, $status);
    }
}
