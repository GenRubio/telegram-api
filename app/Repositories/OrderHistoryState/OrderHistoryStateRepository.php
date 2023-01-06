<?php

namespace App\Repositories\OrderHistoryState;

use App\Models\OrderHistoryState;
use App\Repositories\Repository;

/**
 * Class OrderHistoryStateRepository
 * @package App\Repositories\OrderHistoryState
 */
class OrderHistoryStateRepository extends Repository implements OrderHistoryStateRepositoryInterface
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
     * @var orderHistoryState
     */
    protected $model;

    /**
     * OrderHistoryStateRepository constructor.
     */
    public function __construct()
    {
        $this->model = new OrderHistoryState();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function create($data)
    {
        $this->model->create($data);
    }
}
