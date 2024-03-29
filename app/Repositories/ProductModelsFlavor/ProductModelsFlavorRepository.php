<?php

namespace App\Repositories\ProductModelsFlavor;

use App\Models\ProductModelsFlavor;
use App\Repositories\Repository;

/**
 * Class ProductModelsFlavorRepository
 * @package App\Repositories\ProductModelsFlavor
 */
class ProductModelsFlavorRepository extends Repository implements ProductModelsFlavorRepositoryInterface
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
     * @var productModelsFlavor
     */
    protected $model;

    /**
     * ProductModelsFlavorRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ProductModelsFlavor();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function updateBlockedStock($flavorId, $amount)
    {
        $this->model->where('id', $flavorId)->increment('stock_bloqued', $amount);
    }

    public function updateRemoveBlockedStock($flavorId, $amount)
    {
        $this->model->where('id', $flavorId)->decrement('stock_bloqued', $amount);
    }

    public function updateRemoveStock($flavorId, $amount)
    {
        $this->model->where('id', $flavorId)->decrement('stock', $amount);
    }

    public function getByReference($reference)
    {
        return $this->model->where('reference', $reference)
            ->first();
    }
}
