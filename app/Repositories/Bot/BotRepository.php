<?php

namespace App\Repositories\Bot;

use App\Models\Bot;
use App\Repositories\Repository;

/**
 * Class BotRepository
 * @package App\Repositories\Bot
 */
class BotRepository extends Repository implements BotRepositoryInterface
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
     * @var bot
     */
    protected $model;

    /**
     * BotRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Bot();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}
