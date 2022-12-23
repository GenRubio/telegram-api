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

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
