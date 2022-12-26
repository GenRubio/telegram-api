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
        'sent' => 'sent',
        'delivered' => 'delivered'
    ];
    const STATUS = [
        'cancel' => 'Cancelado',
        'error' => 'Error',
        'pd_payment' => 'Pendiente de pago',
        'pd_sent' => 'Pendiente de envio',
        'payment_accepted' => 'Pago aceptado',
        'sent' => 'Enviado',
        'delivered' => 'Entregado'
    ];
    const STATUS_COLORS = [
        'cancel' => '#df3e3e',
        'error' => '#df3e3e',
        'pd_payment' => '#ffb800',
        'pd_sent' => '#0089ff',
        'payment_accepted' => '#14d2cb',
        'sent' => '#dd13dd',
        'delivered' => '#4add13'
    ];
}
