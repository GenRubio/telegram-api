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
                'message' => 'Bien venido/a a nuestra tienda de Puffs.
Aquí podrás encontrar una amplia cantidad de sabores a un buen precio🤗',
                'created_at' => '2022-12-26 08:10:41',
                'updated_at' => '2022-12-26 09:42:47',
                'description' => 'Mensaje bien venida',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => '1672062323.5633',
                'image' => NULL,
                'message' => 'Hola,  lamentablemente tu pedido ha sido cancelado automáticamente 😢.
Por falta de stock estamos obligados a cancelar los pedidos no abonados en determinado tiempo
Recuerda que el pago del pedido solo esta disponible durante los primeros {time} minutos',
                'created_at' => '2022-12-26 13:45:23',
                'updated_at' => '2022-12-26 13:45:23',
                'description' => 'Pedido cancelado automático',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => '1672062409.0611',
                'image' => NULL,
                'message' => 'Hola',
                'created_at' => '2022-12-26 13:46:49',
                'updated_at' => '2022-12-26 13:46:49',
                'description' => 'Pedido cancelado',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => '1672062424.6009',
                'image' => NULL,
                'message' => 'Hola',
                'created_at' => '2022-12-26 13:47:04',
                'updated_at' => '2022-12-26 13:47:04',
                'description' => 'Pedido enviado',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => '1672062437.1043',
                'image' => NULL,
                'message' => 'Hola',
                'created_at' => '2022-12-26 13:47:17',
                'updated_at' => '2022-12-26 13:47:17',
                'description' => 'Pedido entregado',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => '1672062471.687',
                'image' => NULL,
                'message' => 'Hola',
                'created_at' => '2022-12-26 13:47:51',
                'updated_at' => '2022-12-26 13:47:51',
                'description' => 'Numero seguimiento pedido',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => '1672062515.7575',
                'image' => NULL,
                'message' => 'Hola',
                'created_at' => '2022-12-26 13:48:35',
                'updated_at' => '2022-12-26 13:48:35',
                'description' => 'Url de pago del pedido',
            ),
        ));
        
        
    }
}