<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\ParametricTable;
use App\Repositories\ParametricTable\ParametricTableRepository;
use App\Repositories\ParametricTable\ParametricTableRepositoryInterface;

/**
 * Class ParametricTableService
 * @package App\Services\ParametricTable
 */
class ParametricTableService extends Controller
{
    private $parametrictableRepository;

    /**
     * ParametricTableService constructor.
     * @param ParametricTable $parametrictable
     * @param ParametricTableRepositoryInterface $parametrictableRepository
     */
    public function __construct()
    {
        $this->parametrictableRepository = new ParametricTableRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
