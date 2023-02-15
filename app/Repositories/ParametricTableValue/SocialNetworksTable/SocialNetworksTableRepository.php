<?php

namespace App\Repositories\ParametricTableValue\SocialNetworksTable;

use App\Models\ParametricTableValues\SocialNetworksTable;
use App\Repositories\Repository;
use App\Repositories\ParametricTableValue\ParametricTableValueRepository;

/**
 * Class SocialNetworksTableRepository
 * @package App\Repositories\ParametricTableValue\SocialNetworksTable\SocialNetworksTableRepository
 */
class SocialNetworksTableRepository extends ParametricTableValueRepository implements SocialNetworksTableRepositoryInterface
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
     * @var SocialNetworksTable
     */
    protected $model;

    /**
     * SocialNetworksTableRepository constructor.
     */
    public function __construct()
    {
        $this->model = new SocialNetworksTable();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
