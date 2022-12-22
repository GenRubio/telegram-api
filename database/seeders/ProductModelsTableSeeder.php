<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductModelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_models')->delete();
        
        \DB::table('product_models')->insert(array (
            0 => 
            array (
                'id' => 6,
                'brand_id' => 1,
                'name' => 'HBAR',
                'image' => 'images/product/models/5d1d9ace5f81efbc34df06613cc830ef-image.png',
                'reference' => '202210000',
                'price' => 10.0,
                'discount' => 0.0,
                'size' => '19x42x82',
                'power_range' => '7',
                'input_voltage' => NULL,
                'battery_capacity' => '550',
                'e_liquid_capacity' => '16',
                'concentration' => '50',
                'resistance' => '1.2',
                'absorbable_quantity' => '6000',
                'charging_port' => 'Type-C',
                'active' => 1,
                'created_at' => '2022-12-17 09:13:22',
                'updated_at' => '2022-12-17 09:33:16',
            ),
            1 => 
            array (
                'id' => 7,
                'brand_id' => 1,
                'name' => 'HOT',
                'image' => 'images/product/models/47592aff9fd227338cd53f28974687e4-image.png',
                'reference' => '202210001',
                'price' => 10.0,
                'discount' => 0.0,
                'size' => '47.5x23x82.5',
                'power_range' => '7',
                'input_voltage' => NULL,
                'battery_capacity' => '550',
                'e_liquid_capacity' => NULL,
                'concentration' => '50',
                'resistance' => NULL,
                'absorbable_quantity' => '5000',
                'charging_port' => 'Type-C',
                'active' => 1,
                'created_at' => '2022-12-17 09:18:41',
                'updated_at' => '2022-12-17 09:18:41',
            ),
        ));
        
        
    }
}