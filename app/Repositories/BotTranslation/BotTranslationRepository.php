<?php

namespace App\Repositories\BotTranslation;

use App\Models\BotTranslation;
use App\Repositories\Repository;

/**
 * Class BotTranslationRepository
 * @package App\Repositories\BotTranslation
 */
class BotTranslationRepository extends Repository implements BotTranslationRepositoryInterface
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
     * @var botTranslation
     */
    protected $model;

    /**
     * BotTranslationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new BotTranslation();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }
}
