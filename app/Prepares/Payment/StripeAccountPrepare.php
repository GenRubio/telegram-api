<?php

namespace App\Prepares\Payment;

use App\Enums\PaymentMethodsEnum;
use App\Exceptions\GenericException;
use App\Services\PaymentPlatformKeyService;

class StripeAccountPrepare
{
    private $paymentPlatformKeyService;
    private $paymentPlatformKeys;
    private $selectedKeys;

    public function __construct()
    {
        $this->paymentPlatformKeyService = new PaymentPlatformKeyService();
        $this->paymentPlatformKeys = $this->paymentPlatformKeyService
            ->getAllByType(PaymentMethodsEnum::STRIPE);
    }

    public function run()
    {
        if (count($this->paymentPlatformKeys) == 0) {
            throw new GenericException('No se encontraron las llaves de Stripe');
        }
        $this->selectedKeys = $this->paymentPlatformKeys->random();
        return $this->getPreparedData();
    }

    private function getPreparedData()
    {
        return [
            'secret_key' => decrypt($this->selectedKeys->private_key),
            'public_key' => decrypt($this->selectedKeys->public_key),
        ];
    }
}
