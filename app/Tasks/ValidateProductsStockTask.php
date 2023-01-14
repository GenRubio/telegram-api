<?php

namespace App\Tasks;

use App\Exceptions\GenericException;
use App\Services\ProductModelService;
use App\Tasks\Bot\Translations\StockNotAvailableTextTask;
use App\Tasks\Bot\Translations\FlavorNotAvailableTextTask;
use App\Tasks\Bot\Translations\ProductNotAvailableTextTask;

class ValidateProductsStockTask
{
    private $products;
    private $chat;
    private $productModelService;
    public $flavors;

    public function __construct($products, $chat)
    {
        $this->products = $products;
        $this->chat = $chat;
        $this->productModelService = new ProductModelService();
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
            $item = (object) $item;
            $product = (object) $item->product;
            $productModel = $this->productModelService->getByReference($product->reference);
            if (is_null($productModel)) {
                $errorMessage = (new ProductNotAvailableTextTask($this->chat, [
                    'product_name' => $product->name
                ]))->run();
                throw new GenericException($errorMessage);
            }
            $flavor = $productModel->productModelsFlavors->where('reference', $item->flavor)
                ->first();
            if (is_null($flavor)) {
                throw new GenericException("Error");
            }
            if (!$flavor->active) {
                $errorMessage = (new FlavorNotAvailableTextTask($this->chat, [
                    'flavor_name' => $flavor->name,
                    'product_name' => $productModel->name
                ]))->run();
                throw new GenericException($errorMessage);
            }
            if ($item->amount > $flavor->available_stock) {
                $errorMessage = (new StockNotAvailableTextTask($this->chat, [
                    'flavor_name' => $flavor->name,
                    'product_name' => $productModel->name,
                    'flavor_available_stock' => $flavor->available_stock
                ]))->run();
                throw new GenericException($errorMessage);
            }
            $this->flavors[] = [
                'amount' => $item->amount,
                'flavor' => $flavor
            ];
        }
    }
}
