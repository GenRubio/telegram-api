<?php

namespace App\Prepares\Payment;

use App\Exceptions\GenericException;
use App\Services\PaymentPlatformKeyService;

class PayPalAccountPrepare
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
            throw new GenericException('No se encontraron las llaves de PayPal');
        }
        return $this->getPreparedData();
    }

    private function getPreparedData()
    {
        return [
            'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => decrypt($this->paymentPlatformKey->public_key),
                'client_secret'     => decrypt($this->paymentPlatformKey->private_key),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => decrypt($this->paymentPlatformKey->public_key),
                'client_secret'     => decrypt($this->paymentPlatformKey->private_key),
                'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
            ],
            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => env('PAYPAL_CURRENCY', 'USD'),
            'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale'         => env('PAYPAL_LOCALE', 'es_ES'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];
    }
}
