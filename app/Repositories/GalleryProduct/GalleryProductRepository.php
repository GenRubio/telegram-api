<?php

namespace App\Repositories\GalleryProduct;

use App\Models\GalleryProduct;
use App\Repositories\Repository;

/**
 * Class GalleryProductRepository
 * @package App\Repositories\GalleryProduct
 */
class GalleryProductRepository extends Repository implements GalleryProductRepositoryInterface
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
     * @var GalleryProduct
     */
    protected $model;

    /**
     * GalleryProductRepository constructor.
     */
    public function __construct()
    {
        $this->model = new GalleryProduct();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 86400);
        $this->limit = 10;
    }

    public function getAll()
    {
        return $this->model
            ->orderBy('order', 'asc')
            ->get();
    }
}
