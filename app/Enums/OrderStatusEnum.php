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
    const STATUS_TO_STATUS = [
        'cancel' => [
            'cancel' => self::STATUS['cancel'],
        ],
        'error' => [
            'error' => self::STATUS['error'],
        ],
        'pd_payment' => [
            'pd_payment' => self::STATUS['pd_payment'],
            'cancel' => self::STATUS['cancel'],
        ],
        'payment_accepted' => [
            'payment_accepted' => self::STATUS['payment_accepted'],
            'sent' => self::STATUS['sent'],
            'cancel' => self::STATUS['cancel'],
        ],
        'sent' => [
            'sent' => self::STATUS['sent'],
            'delivered' => self::STATUS['delivered']
        ],
        'delivered' => [
            'delivered' => self::STATUS['delivered']
        ]
    ];
}
