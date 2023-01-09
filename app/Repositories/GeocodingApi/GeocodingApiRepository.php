<?php

namespace App\Repositories\GeocodingApi;

use App\Models\GeocodingApi;
use App\Repositories\Repository;

/**
 * Class GeocodingApiRepository
 * @package App\Repositories\GeocodingApi
 */
class GeocodingApiRepository extends Repository implements GeocodingApiRepositoryInterface
{
    /**
     * @var int Limit for retrieve data
     */
    protected $limit;

    /**
     * @var int defaultTtl for cache
     */
    protected $defaultTtl;

    /**
     * @var geocodingApi
     */
    protected $model;

    /**
     * GeocodingApiRepository constructor.
     */
    public function __construct()
    {
        $this->model = new GeocodingApi();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function incrementRequests($key)
    {
        $this->model->where('api_key', $key)
            ->increment('requests', 1);
    }

    public function incrementTotalRequests($key)
    {
        $this->model->where('api_key', $key)
            ->increment('total_requests', 1);
    }

    public function update($key, $data)
    {
        $this->model->where('api_key', $key)
            ->update($data);
    }

    public function getEnabled()
    {
        return $this->model->where('requests', '<', 2400)
            ->first();
    }
}
