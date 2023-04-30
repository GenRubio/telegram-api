<?php

namespace App\Prepares\Payment;

use App\Exceptions\GenericException;
use App\Services\PaymentPlatformKeyService;

class StripeAccountPrepare
{
    private $paymentPlatformKeyId;
    private $paymentPlatformKeyService;
    private $paymentPlatformKey;

    public function __construct($paymentPlatformKeyId)
    {
        $this->paymentPlatformKeyId = $paymentPlatformKeyId;
        $this->paymentPlatformKeyService = new PaymentPlatformKeyService();
        $this->paymentPlatformKey = $this->paymentPlatformKeyService
            ->getById($this->paymentPlatformKeyId);
    }

    public function run()
    {
        if (is_null($this->paymentPlatformKey)) {
            throw new GenericException('No se encontraron las llaves de Stripe');
        }
        return $this->getPreparedData();
    }

    private function getPreparedData()
    {
        return [
            'secret_key' => decrypt($this->paymentPlatformKey->private_key),
            'public_key' => decrypt($this->paymentPlatformKey->public_key),
        ];
    }
}
