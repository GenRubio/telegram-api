<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\PaymentPlatformKey;
use App\Repositories\PaymentPlatformKey\PaymentPlatformKeyRepository;
use App\Repositories\PaymentPlatformKey\PaymentPlatformKeyRepositoryInterface;

/**
 * Class PaymentPlatformKeyService
 * @package App\Services\PaymentPlatformKey
 */
class PaymentPlatformKeyService extends Controller
{
    private $paymentPlatformKeyRepository;

    /**
     * PaymentPlatformKeyService constructor.
     * @param PaymentPlatformKey $PaymentPlatformKey
     * @param PaymentPlatformKeyRepositoryInterface $PaymentPlatformKeyRepository
     */
    public function __construct()
    {
        $this->paymentPlatformKeyRepository = new PaymentPlatformKeyRepository();
    }
}
