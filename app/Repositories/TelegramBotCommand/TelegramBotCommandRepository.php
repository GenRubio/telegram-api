<?php

namespace App\Repositories\TelegramBotCommand;

use App\Models\TelegramBotCommand;
use App\Repositories\Repository;

/**
 * Class TelegramBotCommandRepository
 * @package App\Repositories\TelegramBotCommand
 */
class TelegramBotCommandRepository extends Repository implements TelegramBotCommandRepositoryInterface
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
     * @var telegramBotCommand
     */
    protected $model;

    /**
     * TelegramBotCommandRepository constructor.
     */
    public function __construct()
    {
        $this->model = new TelegramBotCommand();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getAll()
    {
        return $this->model->get();
    }
}
