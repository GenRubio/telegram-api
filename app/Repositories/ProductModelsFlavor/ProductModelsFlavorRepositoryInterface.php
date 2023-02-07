<?php

namespace App\Repositories\ProductModelsFlavor;

/**
 * Interface ProductModelsFlavorRepositoryInterface
 * @package App\Repositories\ProductModelsFlavor
 */
interface ProductModelsFlavorRepositoryInterface
{
    public function updateBlockedStock($flavorId, $amount);
    public function updateRemoveBlockedStock($flavorId, $amount);
    public function updateRemoveStock($flavorId, $amount);
    public function getByReference($reference);
}
