<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\ParametricTableValue;
use App\Repositories\ParametricTableValue\ParametricTableValueRepository;
use App\Repositories\ParametricTableValue\ParametricTableValueRepositoryInterface;

/**
 * Class ParametricTableValueService
 * @package App\Services\ParametricTableValue
 */
class ParametricTableValueService extends Controller
{
    private $parametrictablevalueRepository;

    /**
     * ParametricTableValueService constructor.
     * @param ParametricTableValue $parametrictablevalue
     * @param ParametricTableValueRepositoryInterface $parametrictablevalueRepository
     */
    public function __construct()
    {
        $this->parametrictablevalueRepository = new ParametricTableValueRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
