<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductModelsFlavorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_models_flavors')->delete();
        
        \DB::table('product_models_flavors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_model_id' => 6,
                'reference' => '202210000',
                'name' => 'PEACH ICE',
                'image' => 'images/product/models/flavors/765a90558d68bbeced1d9ac341182a69-image.png',
                'stock' => 10,
                'stock_bloqued' => 0,
                'active' => 1,
                'created_at' => '2022-12-17 09:14:10',
                'updated_at' => '2022-12-29 09:32:27',
            ),
            1 => 
            array (
                'id' => 2,
                'product_model_id' => 6,
                'reference' => '202210001',
                'name' => 'GRAPEY',
                'image' => 'images/product/models/flavors/482e7892844af6e70d150d8fbbe2e146-image.png',
                'stock' => 10,
                'stock_bloqued' => 0,
                'active' => 1,
                'created_at' => '2022-12-17 09:14:40',
                'updated_at' => '2022-12-29 09:32:27',
            ),
            2 => 
            array (
                'id' => 3,
                'product_model_id' => 6,
                'reference' => '202210002',
                'name' => 'CACTUS KIWI',
                'image' => 'images/product/models/flavors/1ebfec5538a5afd8eefa0fce1a6de6d6-image.png',
                'stock' => 10,
                'stock_bloqued' => 0,
                'active' => 1,
                'created_at' => '2022-12-17 09:15:06',
                'updated_at' => '2022-12-25 13:23:34',
            ),
            3 => 
            array (
                'id' => 4,
                'product_model_id' => 7,
                'reference' => '202210003',
                'name' => 'PINEAPPLE',
                'image' => 'images/product/models/flavors/d0c58645f8d340c770e0777e253c3865-image.png',
                'stock' => 9,
                'stock_bloqued' => 0,
                'active' => 1,
                'created_at' => '2022-12-17 09:19:19',
                'updated_at' => '2022-12-26 13:29:41',
            ),
            4 => 
            array (
                'id' => 5,
                'product_model_id' => 7,
                'reference' => '202210004',
                'name' => 'PEACH ICE',
                'image' => 'images/product/models/flavors/3c98683906f1b90b291927c91c5b15a5-image.png',
                'stock' => 9,
                'stock_bloqued' => 0,
                'active' => 1,
                'created_at' => '2022-12-17 09:23:09',
                'updated_at' => '2022-12-26 13:29:42',
            ),
        ));
        
        
    }
}