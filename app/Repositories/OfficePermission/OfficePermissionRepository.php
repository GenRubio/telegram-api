<?php

namespace App\Repositories\OfficePermission;

use App\Models\OfficePermission;
use App\Repositories\Repository;

/**
 * Class OfficePermissionRepository
 * @package App\Repositories\OfficePermission
 */
class OfficePermissionRepository extends Repository implements OfficePermissionRepositoryInterface
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
     * @var officePermission
     */
    protected $model;

    /**
     * OfficePermissionRepository constructor.
     */
    public function __construct()
    {
        $this->model = new OfficePermission();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByCrudAndMethod($crud, $name)
    {
        return $this->model->where('crud_controller', $crud)
            ->where('name', $name)
            ->first();
    }
}
