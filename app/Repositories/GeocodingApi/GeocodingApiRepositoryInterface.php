<?php

namespace App\Repositories\GeocodingApi;

/**
 * Interface GeocodingApiRepositoryInterface
 * @package App\Repositories\GeocodingApi
 */
interface GeocodingApiRepositoryInterface
{
    public function incrementRequests($key);
    public function incrementTotalRequests($key);
    public function update($key, $data);
    public function getEnabled();
}
