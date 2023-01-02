<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TelegramBotGroupBotTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('telegram_bot_group_bot')->delete();
        
        \DB::table('telegram_bot_group_bot')->insert(array (
            0 => 
            array (
                'id' => 1,
                'telegram_bot_group_id' => 1,
                'telegraph_bot_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}