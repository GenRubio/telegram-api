<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\ProductModelsFlavor;
use App\Repositories\ProductModelsFlavor\ProductModelsFlavorRepository;
use App\Repositories\ProductModelsFlavor\ProductModelsFlavorRepositoryInterface;

/**
 * Class ProductModelsFlavorService
 * @package App\Services\ProductModelsFlavor
 */
class ProductModelsFlavorService extends Controller
{
    private $productmodelsflavorRepository;

    /**
     * ProductModelsFlavorService constructor.
     * @param ProductModelsFlavor $productmodelsflavor
     * @param ProductModelsFlavorRepositoryInterface $productmodelsflavorRepository
     */
    public function __construct()
    {
        $this->productmodelsflavorRepository = new ProductModelsFlavorRepository();
    }

    public function updateBlockedStock($flavorId, $amount)
    {
        $this->productmodelsflavorRepository->updateBlockedStock($flavorId, $amount);
    }

    public function updateRemoveBlockedStock($flavorId, $amount)
    {
        $this->productmodelsflavorRepository->updateRemoveBlockedStock($flavorId, $amount);
    }

    public function updateRemoveStock($flavorId, $amount)
    {
        $this->productmodelsflavorRepository->updateRemoveStock($flavorId, $amount);
    }

    public function getByReference($reference)
    {
        return $this->productmodelsflavorRepository->getByReference($reference);
    }
}
