<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TelegramBotMessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('telegram_bot_messages')->delete();
        
        \DB::table('telegram_bot_messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => '1672042240.2779',
                'image' => 'images/bot/77b8b6ab9cc8cd8ba09d69c80933a67f-image.png',
                'message' => '{"es":"<p>Bienvenido\\/a a \\"Puffs Costa Brava\\"!<\\/p><p>Lo mejor de desechables en Espa\\u00f1a \\ud83e\\udd17<\\/p><p><span style=\\"font-size: 1rem;\\">Ofrecemos todo lo mejor del mundo de cigarro electr\\u00f3nico.<\\/span><\\/p><p>HQD\'s ya en estock!<br><\\/p>","en":"<p>Welcome to \\"Puffs Costa Brava\\"!\\r\\n<\\/p><p>The best of disposables in Spain \\ud83e\\udd17\\r\\n<\\/p><p>We offer all the best in the world of electronic cigarettes.\\r\\n<\\/p><p>HQD\'s already in stock!<\\/p>","ru":null}',
                'created_at' => '2022-12-26 08:10:41',
                'updated_at' => '2022-12-29 14:49:17',
                'description' => 'Mensaje bienvenida',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => '1672062323.5633',
                'image' => NULL,
                'message' => '{"es":"<p>Hola,  lamentablemente el tiempo de espera se ha expirado \\ud83d\\ude22.\\r\\n<\\/p><p>Recuerda que tiene <b>[time]<\\/b> minutos para abonar el pago antes de que termine tu reserva del stock.<\\/p>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:45:23',
                'updated_at' => '2022-12-29 15:13:20',
                'description' => 'Pedido cancelado automático',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => '1672062409.0611',
                'image' => NULL,
                'message' => '{"es":"<p>Hola, su pedido <b>[reference]<\\/b> ha sido cancelado\\r\\n<\\/p><p>[detail]<\\/p>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:46:49',
                'updated_at' => '2022-12-29 15:13:05',
                'description' => 'Pedido cancelado',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => '1672062424.6009',
                'image' => NULL,
                'message' => '{"es":"<p>Hola, su pedido <b>[reference]<\\/b> ha sido enviado!\\r\\n<\\/p><p>De pronto le enviaremos el numero de seguimiento.<\\/p>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:47:04',
                'updated_at' => '2022-12-29 15:12:54',
                'description' => 'Pedido enviado',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => '1672062437.1043',
                'image' => NULL,
                'message' => '{"es":"<p>Hola, nos lleg\\u00f3 mensaje de la empresa distribuidora de que su envi\\u00f3 <b>[reference]<\\/b> lleg\\u00f3 al destino.\\r\\n<\\/p><p>Le agradecemos por haber elegido a nosotros!\\r\\n<\\/p><p>En el caso de alg\\u00fan incidente no dude en contactar con nosotros a trav\\u00e9s del [chat].<\\/p>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:47:17',
                'updated_at' => '2022-12-29 15:12:37',
                'description' => 'Pedido entregado',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => '1672062471.687',
                'image' => NULL,
                'message' => '{"es":"<p>Hola,  ya esta disponible la Url de seguimiento de tu pedido\\r\\n<\\/p><p>Referencia: <b>[reference]<\\/b><\\/p>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:47:51',
                'updated_at' => '2022-12-29 15:12:22',
                'description' => 'Numero seguimiento pedido',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => '1672062515.7575',
                'image' => NULL,
            'message' => '{"es":"<p>Gracias por estar con nosotros\\r\\n<\\/p><p>Haga click en el bot\\u00f3n Pagar para abonar el pago\\r\\n<\\/p><p>Gracias :)<\\/p>","en":null,"ru":null}',
            'created_at' => '2022-12-26 13:48:35',
            'updated_at' => '2022-12-29 14:49:40',
            'description' => 'Url de pago del pedido',
        ),
        7 => 
        array (
            'id' => 8,
            'key' => '1672078516.7314',
            'image' => NULL,
            'message' => '{"es":"<p>Su pedido <b>[reference]<\\/b> ha sido realizado correctamente!\\r\\n<\\/p><p>Le mand\\u00e1ramos un mensaje cuando su pedido se haya enviado<\\/p>","en":null,"ru":null}',
            'created_at' => '2022-12-26 18:15:16',
            'updated_at' => '2022-12-29 15:10:22',
            'description' => 'Pago aceptado',
        ),
        8 => 
        array (
            'id' => 9,
            'key' => '1672899563.642',
            'image' => NULL,
            'message' => '{"es":"<p>El pago fue cancelado \\ud83e\\udd7a.<\\/p><p><b>\\u00a1No reutilices las url de pago! <\\/b><\\/p><p>Vuelva a realizar el pedido desde nuestra tienda para obtener nuevo url de pago&nbsp;<\\/p>","en":null,"ru":null}',
            'created_at' => '2023-01-05 06:19:23',
            'updated_at' => '2023-01-05 06:19:23',
            'description' => 'Pago cancelado',
        ),
        9 => 
        array (
            'id' => 10,
            'key' => '1672899914.5809',
            'image' => NULL,
            'message' => '{"es":"El pedido ha sido cancelado.","en":null,"ru":null}',
            'created_at' => '2023-01-05 06:25:14',
            'updated_at' => '2023-01-08 09:12:11',
            'description' => 'Url pago cancelada',
        ),
        10 => 
        array (
            'id' => 11,
            'key' => '1673016874.7175',
            'image' => NULL,
            'message' => '{"es":"<p>Tu pago ha sido cancelado.<\\/p><p>Pedido: <b>[reference]<\\/b>&nbsp;<\\/p><p>No disponemos de suficiente stock de productos, su pago se ha cancelado.<\\/p><p>En caso de alguna duda p\\u00f3ngase en contacto con un administrador de nuestra tienda.<\\/p><p><br><\\/p><p>Le recordamos no reutilizar las url de pago.<\\/p>","en":null,"ru":null}',
            'created_at' => '2023-01-06 14:54:34',
            'updated_at' => '2023-01-08 08:52:07',
            'description' => 'Pago denegado',
        ),
        11 => 
        array (
            'id' => 12,
            'key' => '1673103329.4375',
            'image' => NULL,
            'message' => '{"es":"<p>Ha ocurrido un error al realizar el pago.<\\/p><p>Pedido: <b>[reference]<\\/b><\\/p><p>P\\u00f3ngase en contacto con un administrador de nuestra tienda<\\/p>","en":null,"ru":null}',
            'created_at' => '2023-01-07 14:55:29',
            'updated_at' => '2023-01-07 14:55:29',
            'description' => 'Error pago',
        ),
    ));
        
        
    }
}