<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Español',
                'flag' => NULL,
                'abbr' => 'es',
                'script' => NULL,
                'native' => 'Español',
                'active' => 1,
                'default' => 1,
                'created_at' => '2022-12-23 05:49:04',
                'updated_at' => '2022-12-23 05:50:13',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ingles',
                'flag' => NULL,
                'abbr' => 'en',
                'script' => NULL,
                'native' => 'English',
                'active' => 1,
                'default' => 0,
                'created_at' => '2022-12-23 05:49:22',
                'updated_at' => '2022-12-23 05:50:13',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ruso',
                'flag' => NULL,
                'abbr' => 'ru',
                'script' => NULL,
                'native' => 'Русский',
                'active' => 1,
                'default' => 0,
                'created_at' => '2022-12-23 05:50:03',
                'updated_at' => '2022-12-23 05:50:13',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}