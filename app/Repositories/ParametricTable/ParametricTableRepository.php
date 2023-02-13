<?php

namespace App\Repositories\ParametricTable;

use App\Models\ParametricTable;
use App\Repositories\Repository;

/**
 * Class ParametricTableRepository
 * @package App\Repositories\ParametricTable
 */
class ParametricTableRepository extends Repository implements ParametricTableRepositoryInterface
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
     * @var parametricTable
     */
    protected $model;

    /**
     * ParametricTableRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ParametricTable();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
