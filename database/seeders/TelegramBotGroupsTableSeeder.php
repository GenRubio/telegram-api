<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TelegramBotGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('telegram_bot_groups')->delete();
        
        \DB::table('telegram_bot_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => '1672571380.1304',
                'name' => 'Bots mensajes globales',
                'created_at' => '2023-01-01 11:09:40',
                'updated_at' => '2023-01-01 11:11:30',
            ),
        ));
        
        
    }
}