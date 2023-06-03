<?php

return [
    'backpack_menu' => [
        'labels' => [
            'shop' => 'TIENDA',
            'telegram_bot' => 'TELEGRAM BOT',
            'config' => 'CONFIGURACIÓN',
            'admin' => 'ADMINISTRACIÓN',
        ],
        'buttons' => [
            'orders' => 'Pedidos',
            'products' => 'Productos',
            'brands' => 'Marcas',
            'affiliates' => 'Afiliados',
            'bots' => 'Bots',
            'grups' => 'Grupos',
            'messages' => 'Mensajes',
            'glabals' => 'Globales',
            'default' => 'Predefinidos',
            'languages' => 'Idiomas',
            'translations' => 'Traducciones',
            'extras' => 'Extras',
            'config' => 'Configuración',
            'social_networks' => 'Redes Sociales',
            'backoffice' => 'BackOffice',
            'parametric_tables' => 'Tablas Paramétricas',
            'site_translation' => 'Traducción del Panel',
            'users' => 'Usuarios',
            'permissions' => 'Permisos',
            'server' => 'Servidor',
            'api_clients' => 'Clientes API',
            'geocoding' => 'Geocoding',
            'payment_keys' => 'Claves de Pago',
            'elfinder' => 'Elfinder',
            'logs' => 'Logs',
            'backups' => 'Backups',
        ],
        'orders' => [
            'list' => [
                'date' => 'Fecha',
                'state' => 'Estado',
                'reference' => 'Referencia',
                'total_price' => 'Precio Total',
                'price' => 'Precio',
                'price_shipping' => 'Precio Envío',
                'payment_keys' => 'Claves de Pago',
                'actions' => 'Acciones',
                'action_buttons' => [
                    'products' => 'Productos',
                    'states' => 'Estados',
                ]
            ],
            'states' => [
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
            ],
            'update' => [
                'tabs' => [
                    'general' => 'General',
                    'client' => 'Cliente',
                    'payment' => 'Pago',
                ],
                'general' => [
                    'reference' => 'Referencia',
                    'state' => 'Estado',
                    'payment_cancel_problem' => 'Razon de cancelacion de pedido',
                    'explication_text' => 'En caso de que el estado sea Cancelado',
                    'client_language' => 'Idioma del cliente',
                    'provider_url' => 'Url del proveedor',
                    'price' => 'Precio',
                    'price_shipping' => 'Precio Envío',
                    'total_price' => 'Precio Total',
                ],
                'client' => [
                    'name' => 'Nombre',
                    'surname' => 'Apellidos',
                    'email' => 'Email',
                    'phone' => 'Teléfono',
                    'address' => 'Dirección',
                    'city' => 'Ciudad',
                    'province' => 'Provincia',
                    'country' => 'País',
                    'postal_code' => 'Código Postal',
                ],
                'payment' => [
                    'stripe_order_id' => 'ID Pedido (Stripe)',
                    'paypal_order_id' => 'ID Pedido (Paypal)',
                    'payment_id' => 'ID Pago',
                    'paypal_payment_url' => 'URL Pago (Paypal)',
                    'order_state' => 'Estado Pedido',
                    'payment_state' => 'Estado Pago',
                    'payment_keys' => 'Claves de Pago',
                    'payment_method' => 'Método de Pago',
                ]
            ]
        ]
    ]
];
