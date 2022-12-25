<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 2,
                'key' => '1671891736.2341',
                'description' => 'Cantidad de euros mínimo para envió gratuito',
                'value' => '40',
                'created_at' => '2022-12-24 14:22:16',
                'updated_at' => '2022-12-24 14:22:16',
            ),
            1 => 
            array (
                'id' => 3,
                'key' => '1671891779.1284',
                'description' => 'Costes de envió en euros',
                'value' => '8',
                'created_at' => '2022-12-24 14:22:59',
                'updated_at' => '2022-12-24 14:22:59',
            ),
            2 => 
            array (
                'id' => 4,
                'key' => '1671894524.6744',
                'description' => 'Url Bot Telegram',
                'value' => 'https://t.me/HQTStoreBot',
                'created_at' => '2022-12-24 15:08:44',
                'updated_at' => '2022-12-24 15:08:44',
            ),
            3 => 
            array (
                'id' => 5,
                'key' => '1671967273.4378',
                'description' => 'Tiempo valido para la Url de pago en minutos',
                'value' => '60',
                'created_at' => '2022-12-25 11:21:13',
                'updated_at' => '2022-12-25 11:21:13',
            ),
        ));
        
        
    }
}