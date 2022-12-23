<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Repositories\ProductModel\ProductModelRepository;
use App\Repositories\ProductModel\ProductModelRepositoryInterface;

/**
 * Class ProductModelService
 * @package App\Services\ProductModel
 */
class ProductModelService extends Controller
{
    private $productmodelRepository;

    /**
     * ProductModelService constructor.
     * @param ProductModel $productmodel
     * @param ProductModelRepositoryInterface $productmodelRepository
     */
    public function __construct()
    {
        $this->productmodelRepository = new ProductModelRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
