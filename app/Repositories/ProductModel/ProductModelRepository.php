<?php

namespace App\Repositories\ProductModel;

use App\Models\ProductModel;
use App\Repositories\Repository;

/**
 * Class ProductModelRepository
 * @package App\Repositories\ProductModel
 */
class ProductModelRepository extends Repository implements ProductModelRepositoryInterface
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
     * ProductModelRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ProductModel();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 86400);
        $this->limit = 10;
    }

    public function enabled($reference)
    {
        return $this->model->where('reference', $reference)
            ->active()
            ->first();
    }

    public function getByReferences($references)
    {
        return $this->model->whereIn('reference', $references)
            ->active()
            ->get();
    }

    public function getByReference($reference)
    {
        return $this->model->where('reference', $reference)
            ->active()
            ->first();
    }

    public function getAllActive()
    {
        return $this->model->where('active', true)
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getAll()
    {
        return $this->model
            ->orderBy('order', 'asc')
            ->get();
    }

    public function get($filter)
    {
        return $this->model
            ->nicotine($filter['nicotine'])
            ->brands($filter['brands'])
            ->orderByCustom($filter['order_by'])
            ->where('active', true)
            ->get();
    }
}
