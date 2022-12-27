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
                'message' => '{"es":"Bienvenido\\/a a \\"Puffs Costa Brava\\"!\\r\\nLo mejor de desechables en Espa\\u00f1a \\ud83e\\udd17\\r\\nOfrecemos todo lo mejor del mundo de cigarro electronico.\\r\\nHQD\'s ya en estock!","en":"Welcome to \\"Puffs Costa Brava\\"!\\r\\nThe best of disposables in Spain \\ud83e\\udd17\\r\\nWe offer all the best in the world of electronic cigarettes.\\r\\nHQD\'s already in stock!","ru":null}',
                'created_at' => '2022-12-26 08:10:41',
                'updated_at' => '2022-12-27 11:56:31',
                'description' => 'Mensaje bienvenida',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => '1672062323.5633',
                'image' => NULL,
                'message' => '{"es":"Hola,  lamentablemente el tiempo de espera se ha expirado \\ud83d\\ude22.\\r\\nRecuerda que tiene  <time> minutos para abonar el pago antes de que termine tu reserva del stock.","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:45:23',
                'updated_at' => '2022-12-27 12:30:01',
                'description' => 'Pedido cancelado automático',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => '1672062409.0611',
                'image' => NULL,
                'message' => '{"es":"Hola, su pedido <reference> ha sido cancelado\\r\\nLe recordamos que puede contactar con nosotros a trav\\u00e9s del chat <chat>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:46:49',
                'updated_at' => '2022-12-27 13:18:30',
                'description' => 'Pedido cancelado',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => '1672062424.6009',
                'image' => NULL,
                'message' => '{"es":"Hola, su pedido <reference> ha sido enviado!\\r\\nDe pronto le enviaremos el numero de seguimiento.","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:47:04',
                'updated_at' => '2022-12-27 13:16:49',
                'description' => 'Pedido enviado',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => '1672062437.1043',
                'image' => NULL,
                'message' => '{"es":"Hola, nos lleg\\u00f3 mensaje de la empresa distribuidora de que su envi\\u00f3 <reference> lleg\\u00f3 al destino.\\r\\nLe agradecemos por haber elegido a nosotros!\\r\\nEn el caso de alg\\u00fan incidente no dude en contactar con nosotros a trav\\u00e9s del {chat}.","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:47:17',
                'updated_at' => '2022-12-27 13:17:48',
                'description' => 'Pedido entregado',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => '1672062471.687',
                'image' => NULL,
                'message' => '{"es":"Hola, su c\\u00f3digo de seguimiento es <correos>","en":null,"ru":null}',
                'created_at' => '2022-12-26 13:47:51',
                'updated_at' => '2022-12-27 13:17:30',
                'description' => 'Numero seguimiento pedido',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => '1672062515.7575',
                'image' => NULL,
            'message' => '{"es":"Gracias por estar con nosotros\\r\\nHaga click en el bot\\u00f3n Pagar para abonar el pago\\r\\nGracias :)","en":null,"ru":null}',
            'created_at' => '2022-12-26 13:48:35',
            'updated_at' => '2022-12-27 12:46:33',
            'description' => 'Url de pago del pedido',
        ),
        7 => 
        array (
            'id' => 8,
            'key' => '1672078516.7314',
            'image' => NULL,
            'message' => '{"es":"Su pedido <reference> ha sido realizado correctamente!\\r\\nLe mand\\u00e1ramos un mensaje cuando su pedido se haya enviado","en":null,"ru":null}',
            'created_at' => '2022-12-26 18:15:16',
            'updated_at' => '2022-12-27 13:06:29',
            'description' => 'Pago aceptado',
        ),
    ));
        
        
    }
}