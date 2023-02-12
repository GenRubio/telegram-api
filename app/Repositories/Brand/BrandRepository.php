<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\Repository;

/**
 * Class BrandRepository
 * @package App\Repositories\Brand
 */
class BrandRepository extends Repository implements BrandRepositoryInterface
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
     * @var brand
     */
    protected $model;

    /**
     * BrandRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Brand();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getAllActive()
    {
        return $this->model->where('active', true)->get();
    }
}
