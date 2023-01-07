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
        'payment_completed' => 'payment_completed',
        'payment_late' => 'payment_late',
        'payment_denied' => 'payment_denied',
        'sent' => 'sent',
        'delivered' => 'delivered',
        'refund' => 'refund'
    ];
    const STATUS = [
        'cancel' => 'Cancelado',
        'error' => 'Error',
        'pd_payment' => 'Pendiente de pago',
        'pd_sent' => 'Pendiente de envio',
        'payment_accepted' => 'Pago aceptado',
        'payment_completed' => 'Pago completado',
        'payment_late' => 'Pago atrasado',
        'payment_denied' => 'Pago denegado',
        'sent' => 'Enviado',
        'delivered' => 'Entregado',
        'refund' => 'Pago reembolsado'
    ];
    const STATUS_COLORS = [
        'cancel' => '#df3e3e',
        'error' => '#df3e3e',
        'payment_late' => '#df3e3e',
        'pd_payment' => '#ffb800',
        'payment_denied' => '#df3e3e',
        'pd_sent' => '#0089ff',
        'payment_accepted' => '#14d2cb',
        'payment_completed' => '#14d2cb',
        'sent' => '#dd13dd',
        'delivered' => '#4add13',
        'refund' => '#5a5a5a'
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
        ],
        'payment_denied' => [
            'payment_denied' => self::STATUS['payment_denied'],
        ],
        'payment_late' => [
            'payment_late' => self::STATUS['payment_late'],
        ],
        'payment_completed' => [
            'payment_completed' => self::STATUS['payment_completed'],
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
