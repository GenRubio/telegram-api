<?php

namespace App\Repositories\ParametricTableValue\SettingsTable;

use App\Models\ParametricTableValues\SettingsTable;
use App\Repositories\Repository;
use App\Repositories\ParametricTableValue\ParametricTableValueRepository;

/**
 * Class SettingsTableRepository
 * @package App\Repositories\ParametricTableValue\SettingsTable\SettingsTableRepository
 */
class SettingsTableRepository extends ParametricTableValueRepository implements SettingsTableRepositoryInterface
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
     * @var SettingsTable
     */
    protected $model;

    /**
     * SettingsTableRepository constructor.
     */
    public function __construct()
    {
        $this->model = new SettingsTable();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
