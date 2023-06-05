<?php

namespace App\Enums;

abstract class BotGlobalMessagesEnum
{
    const STATUS_IDS = [
        'cancel' => 'cancel',
        'error' => 'error',
        'pd_sent' => 'pd_sent',
        'sent' => 'sent',
    ];
    public static function STATUS()
    {
        return [
            'cancel' => trans('back-office.backpack_menu.glabal_messages.states.cancel'),
            'error' => trans('back-office.backpack_menu.glabal_messages.states.error'),
            'pd_sent' => trans('back-office.backpack_menu.glabal_messages.states.pd_sent'),
            'sent' => trans('back-office.backpack_menu.glabal_messages.states.sent'),
        ];
    }
    const STATUS_COLORS = [
        'cancel' => '#df3e3e',
        'error' => '#df3e3e',
        'pd_sent' => '#0089ff',
        'sent' => '#4add13',
    ];
}
