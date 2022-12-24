<?php

namespace App\Tasks;

use App\Exceptions\GenericException;
use App\Services\ProductModelService;

class ValidateProductsStockTask
{
    private $products;
    private $productModelService;

    public function __construct($products)
    {
        $this->products = $products;
        $this->productModelService = new ProductModelService();
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
                throw new GenericException("El producto {$product->name} ya no esta disponible");
            }
            $flavor = $productModel->productModelsFlavors->where('reference', $item->flavor)
                ->first();
            if (is_null($flavor)) {
                throw new GenericException("Ha ocurrido un error");
            }
            if (!$flavor->active) {
                throw new GenericException("El sabor {$flavor->name} del producto {$productModel->name} no esta disponible");
            }
            if ($item->amount > $flavor->available_stock) {
                throw new GenericException("No tenemos suficiente stock de {$flavor->name} del producto {$productModel->name}. Stock disponible {$flavor->available_stock}");
            }
        }
    }
}
