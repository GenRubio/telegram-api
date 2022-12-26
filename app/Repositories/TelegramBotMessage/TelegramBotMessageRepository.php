<?php

namespace App\Repositories\TelegramBotMessage;

use App\Models\TelegramBotMessage;
use App\Repositories\Repository;

/**
 * Class TelegramBotMessageRepository
 * @package App\Repositories\TelegramBotMessage
 */
class TelegramBotMessageRepository extends Repository implements TelegramBotMessageRepositoryInterface
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
     * @var telegramBotMessage
     */
    protected $model;

    /**
     * TelegramBotMessageRepository constructor.
     */
    public function __construct()
    {
        $this->model = new TelegramBotMessage();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }
}
