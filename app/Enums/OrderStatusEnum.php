<?php

namespace App\Enums;

abstract class OrderStatusEnum
{
    const STATUS = [
        'error' => 'Error',
        'pd_sent' => 'Pendiente de envio',
        'payment_accepted' => 'Pago aceptado',
        'payment_error' => 'Pago rechazado',
        'sent' => 'Enviado',
        'delivered' => 'Entregado'
    ]; 
}
