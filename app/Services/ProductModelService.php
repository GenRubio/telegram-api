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

    public function enabled($reference)
    {
        return $this->productmodelRepository->enabled($reference) ? true : false;
    }

    public function getByReferences($references)
    {
        return $this->productmodelRepository->getByReferences($references);
    }

    public function getByReference($reference)
    {
        return $this->productmodelRepository->getByReference($reference);
    }

    public function getAllActive()
    {
        return $this->productmodelRepository->getAllActive();
    }

    public function get($filter)
    {
        return $this->productmodelRepository->get($filter);
    }
}
