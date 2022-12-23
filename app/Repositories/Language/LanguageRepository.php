<?php

namespace App\Repositories\Language;

use App\Models\Language;
use App\Repositories\Repository;

/**
 * Class LanguageRepository
 * @package App\Repositories\Language
 */
class LanguageRepository extends Repository implements LanguageRepositoryInterface
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
     * @var language
     */
    protected $model;

    /**
     * LanguageRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Language();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }
}
