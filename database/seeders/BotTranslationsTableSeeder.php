<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BotTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bot_translations')->delete();
        
        \DB::table('bot_translations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => '1673326913.3364',
                'text' => '{"es":"Ha ocurrido un error","en":null,"ru":null}',
                'created_at' => '2023-01-10 05:01:53',
                'updated_at' => '2023-01-10 05:01:53',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => '1673327054.2177',
                'text' => '{"es":"No hemos podido localizar tu direcci\\u00f3n. \\r\\nRequerida que solo hacemos envios a Espa\\u00f1a.","en":null,"ru":null}',
                'created_at' => '2023-01-10 05:04:14',
                'updated_at' => '2023-01-10 05:04:14',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => '1673327120.3528',
                'text' => '{"es":"El producto [product_name] ya no esta disponible","en":null,"ru":null}',
                'created_at' => '2023-01-10 05:05:20',
                'updated_at' => '2023-01-10 05:05:20',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => '1673327156.0906',
                'text' => '{"es":"El sabor [flavor_name] del producto [product_name] no esta disponible","en":null,"ru":null}',
                'created_at' => '2023-01-10 05:05:56',
                'updated_at' => '2023-01-10 05:05:56',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => '1673327205.5788',
                'text' => '{"es":"No tenemos suficiente stock de [flavor_name] del producto [product_name]. \\r\\nStock disponible [flavor_available_stock]","en":null,"ru":null}',
                'created_at' => '2023-01-10 05:06:45',
                'updated_at' => '2023-01-10 05:06:45',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => '1673327276.5674',
                'text' => '{"es":"No hemos podido localizar el pedido","en":null,"ru":null}',
                'created_at' => '2023-01-10 05:07:56',
                'updated_at' => '2023-01-10 05:07:56',
            ),
        ));
        
        
    }
}