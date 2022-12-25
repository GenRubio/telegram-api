<?php

namespace App\Repositories\OrderProduct;

use App\Models\OrderProduct;
use App\Repositories\Repository;

/**
 * Class OrderProductRepository
 * @package App\Repositories\OrderProduct
 */
class OrderProductRepository extends Repository implements OrderProductRepositoryInterface
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
     * @var orderProduct
     */
    protected $model;

    /**
     * OrderProductRepository constructor.
     */
    public function __construct()
    {
        $this->model = new OrderProduct();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function createOrderProducts($data)
    {
        $this->model->insert($data);
    }
}
