<?php

namespace App\Prepares;

use App\Enums\OrderStatusEnum;
use App\Services\SettingService;
use App\Services\ProductModelsFlavorService;

class OrderPrepare
{
    private $telegraphChat;
    private $paymentData;
    private $products;
    private $settingService;
    private $productModelsFlavorService;

    public function __construct($request, $telegraphChat)
    {
        $this->telegraphChat = $telegraphChat;
        $this->paymentData = (object)$request->payment;
        $this->products = $request->products;
        $this->settingService = new SettingService();
        $this->productModelsFlavorService = new ProductModelsFlavorService();
    }

    public function run()
    {
        return [
            'chat_id' => $this->telegraphChat->chat_id,
            'reference' => uniqid($this->telegraphChat->chat_id),
            'name' => $this->paymentData->name,
            'surnames' => $this->paymentData->surnames,
            'address' => $this->paymentData->address,
            'postal_code' => $this->paymentData->postal_code,
            'city' => $this->paymentData->city,
            'province' => $this->paymentData->province,
            'country' => $this->paymentData->country,
            'payment_method' => $this->paymentData->payment_method,
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
            $item = (object)$item;
            $flavor = $this->productModelsFlavorService->getByReference($item->reference);
            if ($flavor->productModel->price != $flavor->productModel->price_with_discount) {
                $price += $flavor->productModel->price_with_discount * $item->amount;
            } else {
                $price += $flavor->productModel->price * $item->amount;
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
