<?php

namespace App\Repositories\ProductModelsFlavor;

/**
 * Interface ProductModelsFlavorRepositoryInterface
 * @package App\Repositories\ProductModelsFlavor
 */
interface ProductModelsFlavorRepositoryInterface
{
    public function updateBlockedStock($flavorId, $amount);
}
