<?php

namespace App\Enums;

abstract class OrderStatusEnum
{
    const STATUS_IDS = [
        'cancel' => 'cancel',
        'error' => 'error',
        'pd_payment' => 'pd_payment',
        'pd_sent' => 'pd_sent',
        'payment_accepted' => 'payment_accepted',
        'payment_error' => 'payment_error',
        'sent' => 'sent',
        'delivered' => 'delivered'
    ];
    const STATUS = [
        'cancel' => 'Cancelado',
        'error' => 'Error',
        'pd_payment' => 'Pendiente de pago',
        'pd_sent' => 'Pendiente de envio',
        'payment_accepted' => 'Pago aceptado',
        'payment_error' => 'Pago rechazado',
        'sent' => 'Enviado',
        'delivered' => 'Entregado'
    ];
}
