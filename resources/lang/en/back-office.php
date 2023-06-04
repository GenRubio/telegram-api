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
                ],
                'state_modal' => [
                    'history_state' => 'Historial de estados',
                    'reference' => 'Referencia',
                    'payment_method' => 'Método de pago',
                    'date' => 'Fecha',
                    'state' => 'Estado',
                    'user' => 'Usuario',
                    'close' => 'Cerrar',
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
                ],
                'errors' => [
                    'invalid_url' => 'Url de seguimiento no tiene formato correcto',
                ]
            ]
        ],
        'products' => [
            'list' => [
                'reference' => 'Referencia',
                'active' => 'Activo',
                'priority' => 'Prioridad',
                'image' => 'Imagen',
                'name' => 'Nombre',
                'total_price' => 'Precio Total',
                'price' => 'Precio',
                'discount' => 'Descuento',
                'brand' => 'Marca',
                'actions' => 'Acciones',
                'action_buttons' => [
                    'flavors' => 'Sabores',
                    'images' => 'Imágenes',
                    'valoration' => 'Valoraciones',
                    'duplicate' => 'Duplicar',
                ],
            ],
            'update' => [
                'tabs' => [
                    'product' => 'Producto',
                    'detail' => 'Detalle',
                ],
                'product' => [
                    'image' => 'Imagen',
                    'name' => 'Nombre',
                    'brand' => 'Marca',
                    'price' => 'Precio',
                    'discount' => 'Descuento',
                    'description' => 'Descripción',
                    'priority' => 'Prioridad',
                    'active' => 'Activo',
                    'contains_multiple_flavors' => 'Contiene varios sabores',
                ],
                'datail' => [
                    'size' => 'Tamaño',
                    'power_range' => 'Rango de potencia',
                    'input_voltage' => 'Voltaje de entrada',
                    'battery_capacity' => 'Capacidad de la batería',
                    'e_liquid_capacity' => 'Capacidad de E Liquid',
                    'concentration' => 'Concentración nicotina',
                    'resistance' => 'Resistencia',
                    'absorbable_quantity' => 'Cantidad de caladas',
                    'charging_port' => 'Puerto de carga',
                ],
                'success' => [
                    'duplicate' => 'Producto duplicado correctamente',
                ],
                'extra' => [
                    'copy' => 'Copiar',
                ]
            ]
        ],
        'brands' => [
            'list' => [
                'name' => 'Nombre',
                'products' => 'Productos',
                'active' => 'Activo',
            ],
            'update' => [
                'name' => 'Nombre',
                'active' => 'Activo',
            ]
        ],
        "affiliates" => [
            'list' => [
                'name' => 'Nombre',
                'surname' => 'Apellidos',
                'identification' => 'Identificación',
                'bot' => 'Bot',
                'clients' => 'Clientes',
                'active' => 'Activo',
                'actions' => 'Acciones',
                'action_buttons' => [
                    'clients' => 'Clientes',
                ],
            ],
            'update' => [
                'name' => 'Nombre',
                'surname' => 'Apellidos',
                'identification' => 'Identificación',
                'bot' => 'Bot',
                'active' => 'Activo',
                'email' => 'Email',
                'phone' => 'Teléfono',
                'iban' => 'IBAN',
                'invitation_url' => 'URL Invitación',
            ]
        ],
        "bots" => [
            'list' => [
                'name' => 'Nombre',
                'webhook' => 'WebHook Active',
                'language' => 'Idioma',
                'bot_url' => 'URL Bot',
                'actions' => 'Acciones',
                'action_buttons' => [
                    'chats' => 'Chats',
                    'commands' => 'Comandos',
                ],
            ],
            'update' => [
                'name' => 'Nombre',
                'token' => 'Token',
                'default_language' => 'Idioma por defecto',
                'bot_url' => 'URL Bot',
            ],
            'success' => [
                'update_webhook' => 'WebHook actualizado correctamente',
                'deleted_webhook' => 'WebHook eliminado correctamente',
            ],
        ],
        "grups" => [
            'list' => [
                'key' => 'Clave',
                'name' => 'Nombre',
                'bots' => 'Bots',
            ],
            'update' => [
                'name' => 'Nombre',
                'bots' => 'Bots',
            ]
        ]
    ]
];
