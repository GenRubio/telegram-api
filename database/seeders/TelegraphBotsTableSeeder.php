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
                'name' => 'HQTStoreBot',
                'created_at' => '2022-12-17 09:28:32',
                'updated_at' => '2022-12-17 09:28:32',
            ),
        ));
        
        
    }
}