<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\Repository;

/**
 * Class OrderRepository
 * @package App\Repositories\Order
 */
class OrderRepository extends Repository implements OrderRepositoryInterface
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
     * @var order
     */
    protected $model;

    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Order();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByReference($reference)
    {
        return $this->model->where('reference', $reference)->first();
    }

    public function createOrder($data)
    {
        return $this->model->create($data);
    }
}
