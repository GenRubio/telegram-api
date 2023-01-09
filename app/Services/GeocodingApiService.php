<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\GeocodingApi;
use App\Repositories\GeocodingApi\GeocodingApiRepository;
use App\Repositories\GeocodingApi\GeocodingApiRepositoryInterface;

/**
 * Class GeocodingApiService
 * @package App\Services\GeocodingApi
 */
class GeocodingApiService extends Controller
{
    private $geocodingapiRepository;

    /**
     * GeocodingApiService constructor.
     * @param GeocodingApi $geocodingapi
     * @param GeocodingApiRepositoryInterface $geocodingapiRepository
     */
    public function __construct()
    {
        $this->geocodingapiRepository = new GeocodingApiRepository();
    }

    public function incrementRequests($key)
    {
        $this->geocodingapiRepository->incrementRequests($key);
    }

    public function incrementTotalRequests($key)
    {
        $this->geocodingapiRepository->incrementTotalRequests($key);
    }

    public function update($key, $data)
    {
        $this->geocodingapiRepository->update($key, $data);
    }

    public function getEnabled()
    {
        return $this->geocodingapiRepository->getEnabled();
    }
}
