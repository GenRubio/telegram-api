<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TelegraphChatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('telegraph_chats')->delete();
        
        \DB::table('telegraph_chats')->insert(array (
            0 => 
            array (
                'id' => 1,
                'chat_id' => '5488974094',
                'name' => '[private] ',
                'telegraph_bot_id' => 1,
                'created_at' => '2022-12-17 09:30:21',
                'updated_at' => '2022-12-17 09:30:21',
            ),
        ));
        
        
    }
}