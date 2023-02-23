<?php

namespace App\Repositories\Translation\APITranslation;

use App\Repositories\Repository;
use App\Models\Translations\APITranslation;
use App\Repositories\Translation\TranslationRepository;

/**
 * Class APITranslationRepository
 * @package App\Repositories\APITranslation
 */
class APITranslationRepository extends TranslationRepository implements APITranslationRepositoryInterface
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
     * @var APITranslation
     */
    protected $model;

    /**
     * APITranslationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new APITranslation();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
