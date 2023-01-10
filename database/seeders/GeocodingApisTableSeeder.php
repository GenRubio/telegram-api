<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeocodingApisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('geocoding_apis')->delete();
        
        \DB::table('geocoding_apis')->insert(array (
            0 => 
            array (
                'id' => 1,
                'api_key' => '2873c4960bd14ab795e4f6d0f79955e9',
                'requests' => 0,
                'total_requests' => 0,
                'created_at' => '2023-01-09 18:32:02',
                'updated_at' => '2023-01-09 18:32:02',
            ),
        ));
        
        
    }
}