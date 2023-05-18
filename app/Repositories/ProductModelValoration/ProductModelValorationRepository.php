<?php

namespace App\Repositories\ProductModelValoration;

use App\Models\ProductModelValoration;
use App\Repositories\Repository;

/**
 * Class ProductModelValorationRepository
 * @package App\Repositories\ProductModelValoration
 */
class ProductModelValorationRepository extends Repository implements ProductModelValorationRepositoryInterface
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
     * @var productModel
     */
    protected $model;

    /**
     * ProductModelValorationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ProductModelValoration();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function getChatValoration($id, $chatId)
    {
        return $this->model->where('product_model_id', $id)
            ->where('chat_id', $chatId)
            ->first();
    }
}
