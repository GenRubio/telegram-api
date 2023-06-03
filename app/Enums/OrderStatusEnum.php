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
    public static function STATUS()
    {
        return [
            'cancel' => trans('back-office.backpack_menu.orders.states.cancel'),
            'error' => trans('back-office.backpack_menu.orders.states.error'),
            'pd_payment' => trans('back-office.backpack_menu.orders.states.pd_payment'),
            'pd_sent' => trans('back-office.backpack_menu.orders.states.pd_sent'),
            'payment_accepted' => trans('back-office.backpack_menu.orders.states.payment_accepted'),
            'payment_completed' => trans('back-office.backpack_menu.orders.states.payment_completed'),
            'payment_late' => trans('back-office.backpack_menu.orders.states.payment_late'),
            'payment_denied' => trans('back-office.backpack_menu.orders.states.payment_denied'),
            'sent' => trans('back-office.backpack_menu.orders.states.sent'),
            'delivered' => trans('back-office.backpack_menu.orders.states.delivered'),
            'refund' => trans('back-office.backpack_menu.orders.states.refund')
        ];
    }
    const STATUS_WEB = [
        'payment_completed' => [
            'trans_id' => 'd72d931b-91c6-421a-baf4-bf0ce086e382',
            'color' => self::STATUS_COLORS['payment_completed']
        ],
        'cancel' => [
            'trans_id' => 'fa69fff0-cce0-40e9-b303-d95cd4bcef3b',
            'color' => self::STATUS_COLORS['cancel']
        ],
        'sent' => [
            'trans_id' => 'c92b6305-f041-4a56-b372-720836a17dea',
            'color' => self::STATUS_COLORS['sent']
        ],
        'delivered' => [
            'trans_id' => 'fe0ce319-5b76-4c93-b0ab-c63ec89cf328',
            'color' => self::STATUS_COLORS['delivered']
        ],
    ];
    const NOT_VALIDATED = [
        'error' => 'error',
        'pd_payment' => 'pd_payment',
        'payment_accepted' => 'payment_accepted',
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
    public static function STATUS_TO_STATUS()
    {
        return [
            'cancel' => [
                'cancel' => self::STATUS()['cancel'],
            ],
            'error' => [
                'error' => self::STATUS()['error'],
            ],
            'pd_payment' => [
                'pd_payment' => self::STATUS()['pd_payment'],
                'cancel' => self::STATUS()['cancel'],
            ],
            'payment_accepted' => [
                'payment_accepted' => self::STATUS()['payment_accepted'],
            ],
            'payment_denied' => [
                'payment_denied' => self::STATUS()['payment_denied'],
            ],
            'payment_late' => [
                'payment_late' => self::STATUS()['payment_late'],
            ],
            'payment_completed' => [
                'payment_completed' => self::STATUS()['payment_completed'],
                'sent' => self::STATUS()['sent'],
                'cancel' => self::STATUS()['cancel'],
            ],
            'sent' => [
                'sent' => self::STATUS()['sent'],
                'delivered' => self::STATUS()['delivered']
            ],
            'delivered' => [
                'delivered' => self::STATUS()['delivered']
            ]
        ];
    }
}
