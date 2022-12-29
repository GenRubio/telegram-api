<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => NULL,
                'created_at' => '2022-12-24 14:45:33',
                'updated_at' => '2022-12-24 14:45:34',
                'stripe_id' => 'cus_N2eHxf8JMcd5Zr',
                'pm_type' => NULL,
                'pm_last_four' => NULL,
                'trial_ends_at' => NULL,
                'chat_id' => '5488974094',
            ),
        ));
        
        
    }
}