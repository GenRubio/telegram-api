<?php

namespace App\Repositories\Setting;

use App\Models\Setting;
use App\Repositories\Repository;

/**
 * Class SettingRepository
 * @package App\Repositories\Setting
 */
class SettingRepository extends Repository implements SettingRepositoryInterface
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
     * @var setting
     */
    protected $model;

    /**
     * SettingRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Setting();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }
}
