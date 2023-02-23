<?php

namespace App\Tasks;

use App\Exceptions\GenericException;
use App\Services\ProductModelsFlavorService;
use App\Tasks\API\Translations\StockNotAvailableTextTask;
use App\Tasks\API\Translations\FlavorNotAvailableTextTask;

class ValidateProductsStockTask
{
    private $products;
    private $chat;
    private $productModelsFlavorService;
    public $flavors;

    public function __construct($products, $chat)
    {
        $this->products = $products;
        $this->chat = $chat;
        $this->productModelsFlavorService = new ProductModelsFlavorService();
        $this->flavors = [];

        $this->run();
    }

    public function run()
    {
        $this->validateProducts();
    }

    private function validateProducts()
    {
        foreach ($this->products as $item) {
            $item = (object)$item;
            $flavor = $this->validateFlavorExist($item);
            $this->valdiateFlavorActive($flavor);
            $this->validateFlavorStock($item, $flavor);
            $this->flavors[] = [
                'amount' => $item->amount,
                'flavor' => $flavor
            ];
        }
    }

    private function validateFlavorStock($item, $flavor)
    {
        if ($item->amount > $flavor->available_stock) {
            $errorMessage = (new StockNotAvailableTextTask($this->chat, [
                'flavor_name' => $flavor->name,
                'product_name' => $flavor->productModel->name,
                'flavor_available_stock' => $flavor->available_stock
            ]))->run();
            throw new GenericException($errorMessage);
        }
    }

    private function validateFlavorExist($item)
    {
        $flavor = $this->productModelsFlavorService->getByReference($item->reference);
        if (is_null($flavor)) {
            throw new GenericException("Error");
        }
        return $flavor;
    }

    private function valdiateFlavorActive($flavor)
    {
        if (!$flavor->active) {
            $errorMessage = (new FlavorNotAvailableTextTask($this->chat, [
                'flavor_name' => $flavor->name,
                'product_name' => $flavor->productModel->name
            ]))->run();
            throw new GenericException($errorMessage);
        }
    }
}
