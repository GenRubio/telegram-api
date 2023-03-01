<?php

namespace App\Repositories\ApiClient;

use App\Models\ApiClient;
use App\Repositories\Repository;

/**
 * Class ApiClientRepository
 * @package App\Repositories\ApiClient
 */
class ApiClientRepository extends Repository implements ApiClientRepositoryInterface
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
     * @var apiClient
     */
    protected $model;

    /**
     * ApiClientRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ApiClient();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getAll()
    {
        return $this->model->active()
            ->get();
    }

    public function getToPing()
    {
        return $this->model->active()
            ->where('validate', true)
            ->get();
    }

    public function setOnline($id, $status)
    {
        $this->model->where('id', $id)->update([
            'online' => $status
        ]);
    }

    public function getOnline()
    {
        return $this->model->active()
            ->where('online', true)
            ->where('validate', true)
            ->get();
    }

    public function getByDomain($domain)
    {
        return $this->model
            ->active()
            ->where('domain', $domain)
            ->get();
    }
}
