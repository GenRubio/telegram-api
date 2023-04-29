<?php

namespace App\Enums;

abstract class PaymentMethodsEnum
{
    const PAYPAL = 'PAYPAL';
    const STRIPE = 'STRIPE';

    const ALL = [
        self::PAYPAL,
        self::STRIPE,
    ];
}