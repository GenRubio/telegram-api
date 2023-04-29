<?php

namespace App\Repositories\PaymentPlatformKey;

use App\Models\PaymentPlatformKey;
use App\Repositories\Repository;

/**
 * Class PaymentPlatformKeyRepository
 * @package App\Repositories\PaymentPlatformKey
 */
class PaymentPlatformKeyRepository extends Repository implements PaymentPlatformKeyRepositoryInterface
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
     * @var PaymentPlatformKey
     */
    protected $model;

    /**
     * PaymentPlatformKeyRepository constructor.
     */
    public function __construct()
    {
        $this->model = new PaymentPlatformKey();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
