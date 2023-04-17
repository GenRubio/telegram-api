<?php

namespace App\Repositories\TelegraphBot;

use App\Models\TelegraphBot;
use App\Repositories\Repository;

/**
 * Class TelegraphBotRepository
 * @package App\Repositories\TelegraphBot
 */
class TelegraphBotRepository extends Repository implements TelegraphBotRepositoryInterface
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
     * @var TelegraphBot
     */
    protected $model;

    /**
     * TelegraphBotRepository constructor.
     */
    public function __construct()
    {
        $this->model = new TelegraphBot();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}
