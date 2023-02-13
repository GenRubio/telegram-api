<?php

namespace App\Repositories\ParametricTableValue;

use App\Models\ParametricTableValue;
use App\Repositories\Repository;

/**
 * Class ParametricTableValueRepository
 * @package App\Repositories\ParametricTableValue
 */
class ParametricTableValueRepository extends Repository implements ParametricTableValueRepositoryInterface
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
     * @var parametricTableValue
     */
    protected $model;

    /**
     * ParametricTableValueRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ParametricTableValue();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
