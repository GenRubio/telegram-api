<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TelegraphBotsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('telegraph_bots')->delete();
        
        \DB::table('telegraph_bots')->insert(array (
            0 => 
            array (
                'id' => 1,
                'token' => '5706325891:AAHUKwPPNcOk4WQ1Kji1TfvYcdAJ24EgP3A',
            'name' => 'HQTStoreBot Test (Es)',
                'created_at' => '2022-12-17 09:28:32',
                'updated_at' => '2023-01-05 18:38:18',
                'bot_url' => 'https://t.me/HQTStoreBot',
                'language_id' => 1,
                'webhook' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'token' => '5497563136:AAHJzGSyd8NeOrU34ohCTjuxph8ubxPw5i4',
            'name' => 'HQD Tienda Prod (Es)',
                'created_at' => '2023-01-05 15:44:15',
                'updated_at' => '2023-01-05 15:44:15',
                'bot_url' => 'https://t.me/HQDTiendaProdEsBot',
                'language_id' => 1,
                'webhook' => 0,
            ),
        ));
        
        
    }
}