<?php

namespace App\Repositories\Affiliate;

use App\Models\Affiliate;
use App\Repositories\Repository;

/**
 * Class AffiliateRepository
 * @package App\Repositories\Affiliate
 */
class AffiliateRepository extends Repository implements AffiliateRepositoryInterface
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
     * @var affiliate
     */
    protected $model;

    /**
     * AffiliateRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Affiliate();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByReference($reference)
    {
        return $this->model->where('reference', $reference)
            ->where('active', true)
            ->first();
    }
}
