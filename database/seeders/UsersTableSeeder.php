<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Gen',
                'email' => 'keylorubio@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$TQgs8iU55Mv3RfANkrydceeGuaKBDP1M0GBWxuOT5rnWos9rStSGe',
                'remember_token' => NULL,
                'created_at' => '2022-12-16 20:50:35',
                'updated_at' => '2022-12-16 20:50:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Grisha',
                'email' => 'grisha@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$rXkuKI/afQ8bHQIQA9VEieSNDYrwYe3Bb9RlJP5cIY.9CW9WKozim',
                'remember_token' => NULL,
                'created_at' => '2023-01-09 19:00:29',
                'updated_at' => '2023-01-09 19:00:29',
            ),
        ));
        
        
    }
}