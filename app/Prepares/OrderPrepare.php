<?php

namespace App\Prepares;

use App\Enums\OrderStatusEnum;
use App\Services\SettingService;
use App\Enums\PaymentMethodsEnum;
use App\Exceptions\GenericException;
use App\Services\PaymentPlatformKeyService;
use App\Services\ProductModelsFlavorService;

class OrderPrepare
{
    private $telegraphChat;
    private $paymentData;
    private $products;
    private $settingService;
    private $productModelsFlavorService;
    private $paymentPlatformKeyService;
    private $paymentPlatformKeys;

    public function __construct($request, $telegraphChat)
    {
        $this->telegraphChat = $telegraphChat;
        $this->paymentData = (object)$request->payment;
        $this->products = $request->products;
        $this->settingService = new SettingService();
        $this->productModelsFlavorService = new ProductModelsFlavorService();
        $this->paymentPlatformKeyService = new PaymentPlatformKeyService();
        $this->paymentPlatformKeys = $this->paymentPlatformKeyService
            ->getAllByType($this->setPaymentMethodType());
    }

    public function run()
    {
        if (count($this->paymentPlatformKeys) == 0) {
            throw new GenericException('No hay claves de pago disponibles');
        }
        return [
            'payment_platform_key_id' => $this->paymentPlatformKeys->random()->id,
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

    private function setPaymentMethodType()
    {
        switch ($this->paymentData->payment_method) {
            case 'paypal':
                return PaymentMethodsEnum::PAYPAL;
            case 'stripe':
                return PaymentMethodsEnum::STRIPE;
            default:
                throw new GenericException('Método de pago no soportado');
        }
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
