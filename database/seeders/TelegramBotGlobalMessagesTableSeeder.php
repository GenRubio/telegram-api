<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TelegramBotGlobalMessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('telegram_bot_global_messages')->delete();
        
        \DB::table('telegram_bot_global_messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'telegram_bot_group_id' => 1,
                'image' => NULL,
                'description' => 'asdfsdf',
                'message' => '{"es":"<p>asdf<\\/p>","en":null,"ru":null}',
                'execution_date' => '2023-01-01 13:11:00',
                'status' => 'sent',
                'created_at' => '2023-01-01 12:11:32',
                'updated_at' => '2023-01-02 06:17:59',
            ),
        ));
        
        
    }
}