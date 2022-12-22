<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'HQD',
                'active' => 1,
                'created_at' => '2022-12-16 20:52:53',
                'updated_at' => '2022-12-16 20:52:53',
            ),
        ));
        
        
    }
}