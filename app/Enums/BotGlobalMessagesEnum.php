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
    const STATUS = [
        'cancel' => 'Cancelado',
        'error' => 'Error',
        'pd_sent' => 'Pendiente de envio',
        'sent' => 'Enviado',
    ];
}
