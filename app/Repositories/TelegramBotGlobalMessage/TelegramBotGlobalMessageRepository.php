<?php

namespace App\Repositories\TelegramBotGlobalMessage;

use App\Models\TelegramBotGlobalMessage;
use App\Repositories\Repository;
use Carbon\Carbon;

/**
 * Class TelegramBotGlobalMessageRepository
 * @package App\Repositories\TelegramBotGlobalMessage
 */
class TelegramBotGlobalMessageRepository extends Repository implements TelegramBotGlobalMessageRepositoryInterface
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
     * @var telegramBotGlobalMessage
     */
    protected $model;

    /**
     * TelegramBotGlobalMessageRepository constructor.
     */
    public function __construct()
    {
        $this->model = new TelegramBotGlobalMessage();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByStatus($status)
    {
        return $this->model->where('status', $status)->get();
    }

    public function getPendingSend($status)
    {
        return $this->model->where('status', $status)
            ->where('execution_date', '<=', Carbon::now())
            ->get();
    }

    public function updateStatus($id, $status)
    {
        $this->model->where('id', $id)
            ->update([
                'status' => $status
            ]);
    }
}
