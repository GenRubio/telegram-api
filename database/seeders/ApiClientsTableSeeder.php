<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApiClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('api_clients')->delete();
        
        \DB::table('api_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'url' => 'https://grand-kangaroo-3ccdb5.netlify.app/',
                'ip' => '34.159.168.235',
                'online' => 1,
                'active' => 1,
                'created_at' => '2022-12-30 11:42:26',
                'updated_at' => '2022-12-30 11:42:26',
            ),
        ));
        
        
    }
}