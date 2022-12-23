<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\Repository;

/**
 * Class CustomerRepository
 * @package App\Repositories\Customer
 */
class CustomerRepository extends Repository implements CustomerRepositoryInterface
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
     * @var customer
     */
    protected $model;

    /**
     * CustomerRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Customer();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
