<?php

namespace App\Prepares;

use App\Enums\OrderStatusEnum;
use App\Services\SettingService;
use App\Services\ProductModelService;

class OrderPrepare
{
    private $customer;
    private $paymentData;
    private $products;
    private $settingService;
    private $productModelService;

    public function __construct($request, $customer)
    {
        $this->customer = $customer;
        $this->paymentData = (object)$request->payment;
        $this->products = $request->products;
        $this->settingService = new SettingService();
        $this->productModelService = new ProductModelService();
    }

    public function run()
    {
        return [
            'chat_id' => $this->customer->chat_id,
            'reference' => uniqid($this->customer->chat_id),
            'name' => $this->paymentData->name,
            'surnames' => $this->paymentData->surnames,
            'address' => $this->paymentData->address,
            'postal_code' => $this->paymentData->postalCode,
            'city' => $this->paymentData->city,
            'country' => $this->paymentData->country,
            'payment_method' => $this->paymentData->paymentMethod,
            'status' => OrderStatusEnum::STATUS_IDS['pd_payment'],
            'price' => $price = $this->getPrice(),
            'shipping_price' => $shippingPrice = $this->getShippingPrice($price),
            'total_price' => ($price + $shippingPrice),
        ];
    }

    private function getPrice()
    {
        $price = 0;
        foreach ($this->products as $item) {
            $productData = (object)$item['product'];
            $productModel = $this->productModelService->getByReference($productData->reference);
            if ($productModel->price != $productModel->price_with_discount) {
                $price += $productModel->price_with_discount * $item['amount'];
            } else {
                $price += $productModel->price * $item['amount'];
            }
        }
        return $price;
    }

    private function getShippingPrice($price)
    {
        $minPriceFreeShippment = $this->settingService->getByKey('1671891736.2341')
            ->value;
        $shippmentPrice = $this->settingService->getByKey('1671891779.1284')
            ->value;
        return $price > $minPriceFreeShippment ? 0 : $shippmentPrice;
    }
}
