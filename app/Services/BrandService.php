<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;

/**
 * Class BrandService
 * @package App\Services\Brand
 */
class BrandService extends Controller
{
    private $brandRepository;

    /**
     * BrandService constructor.
     * @param Brand $brand
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct()
    {
        $this->brandRepository = new BrandRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
