<?php

namespace App\Repositories\Translation\WEBTranslation;

use App\Repositories\Repository;
use App\Models\Translations\WEBTranslation;
use App\Repositories\Translation\TranslationRepository;

/**
 * Class WEBTranslationRepository
 * @package App\Repositories\WEBTranslation
 */
class WEBTranslationRepository extends TranslationRepository implements WEBTranslationRepositoryInterface
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
     * @var WEBTranslation
     */
    protected $model;

    /**
     * WEBTranslationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new WEBTranslation();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
