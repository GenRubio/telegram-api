<?php

namespace App\Repositories\Translation;

use App\Models\Translation;
use App\Repositories\Repository;

/**
 * Class TranslationRepository
 * @package App\Repositories\Translation
 */
class TranslationRepository extends Repository implements TranslationRepositoryInterface
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
     * @var translation
     */
    protected $model;

    /**
     * TranslationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Translation();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getByUUID($uuid)
    {
        return $this->model->where('uuid', $uuid)
            ->first();
    }
}
