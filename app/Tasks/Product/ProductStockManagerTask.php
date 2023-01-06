<?php

namespace App\Tasks\Product;

use App\Services\ProductModelsFlavorService;

class ProductStockManagerTask
{
    private $products;
    private $productModelsFlavorService;

    public function __construct($products)
    {
        $this->products = $products;
        $this->productModelsFlavorService = new ProductModelsFlavorService();
    }

    public function removeStock()
    {
        foreach ($this->products as $item) {
            $this->productModelsFlavorService->updateRemoveStock($item->productModelsFlavor->id, $item->amount);
        }
    }

    public function removeBlockedStock()
    {
        foreach ($this->products as $item) {
            $this->productModelsFlavorService->updateRemoveBlockedStock($item->productModelsFlavor->id, $item->amount);
        }
    }

    /**
     * Comprobar el stock disponibles para un pedido procesado con atraso
     */
    public function enoughStock()
    {
        $response = true;
        foreach ($this->products as $item){
            if ($item->productModelsFlavor->available_stock < $item->amount){
                $response = false;
                break;
            }
        }
        return $response;
    }
}
