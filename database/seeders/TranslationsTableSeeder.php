<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('translations')->delete();
        
        \DB::table('translations')->insert(array (
            0 => 
            array (
                'id' => 2,
                'uuid' => '1671777900.227563a54e6c378b6',
                'text' => '{"es":"VER","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:45:00',
                'updated_at' => '2022-12-23 06:45:00',
            ),
            1 => 
            array (
                'id' => 3,
                'uuid' => '1671777926.404663a54e8662c4e',
                'text' => '{"es":"SABORES","en":"FLAVORS","ru":null}',
                'created_at' => '2022-12-23 06:45:26',
                'updated_at' => '2022-12-23 06:45:26',
            ),
            2 => 
            array (
                'id' => 4,
                'uuid' => '1671777935.899863a54e8fdbabf',
                'text' => '{"es":"A\\u00d1ADIR","en":"ADD","ru":null}',
                'created_at' => '2022-12-23 06:45:35',
                'updated_at' => '2022-12-23 06:45:35',
            ),
            3 => 
            array (
                'id' => 5,
                'uuid' => '1671777971.230363a54eb338392',
                'text' => '{"es":"ESPECIFICACIONES","en":"SPECIFICATIONS","ru":null}',
                'created_at' => '2022-12-23 06:46:11',
                'updated_at' => '2022-12-23 06:46:11',
            ),
            4 => 
            array (
                'id' => 6,
                'uuid' => '1671777986.996363a54ec2f33a9',
                'text' => '{"es":"Sal de nicotina","en":"Nicotine Salt","ru":null}',
                'created_at' => '2022-12-23 06:46:26',
                'updated_at' => '2022-12-23 07:08:21',
            ),
            5 => 
            array (
                'id' => 7,
                'uuid' => '1671778008.413463a54ed864ef9',
                'text' => '{"es":"Cantidad absorbible","en":"Absorbable quantity","ru":null}',
                'created_at' => '2022-12-23 06:46:48',
                'updated_at' => '2022-12-23 07:08:11',
            ),
            6 => 
            array (
                'id' => 8,
                'uuid' => '1671778015.547363a54edf859bd',
                'text' => '{"es":"Tama\\u00f1o","en":"Size","ru":null}',
                'created_at' => '2022-12-23 06:46:55',
                'updated_at' => '2022-12-23 07:08:01',
            ),
            7 => 
            array (
                'id' => 9,
                'uuid' => '1671778023.580863a54ee78dca6',
                'text' => '{"es":"Rango de poder","en":"Power Range","ru":null}',
                'created_at' => '2022-12-23 06:47:03',
                'updated_at' => '2022-12-23 07:07:53',
            ),
            8 => 
            array (
                'id' => 10,
                'uuid' => '1671778039.236463a54ef739b80',
                'text' => '{"es":"Capacidad de la bater\\u00eda","en":"Battery Capacity","ru":null}',
                'created_at' => '2022-12-23 06:47:19',
                'updated_at' => '2022-12-23 07:07:44',
            ),
            9 => 
            array (
                'id' => 11,
                'uuid' => '1671778050.365463a54f025935e',
                'text' => '{"es":"Capacidad de l\\u00edquido","en":"E-liquid Capacity","ru":null}',
                'created_at' => '2022-12-23 06:47:30',
                'updated_at' => '2022-12-23 07:07:34',
            ),
            10 => 
            array (
                'id' => 12,
                'uuid' => '1671778059.778763a54f0bbe1a1',
                'text' => '{"es":"Resistencia","en":"Resistance","ru":null}',
                'created_at' => '2022-12-23 06:47:39',
                'updated_at' => '2022-12-23 07:07:22',
            ),
            11 => 
            array (
                'id' => 13,
                'uuid' => '1671778073.652763a54f199f58d',
                'text' => '{"es":"Puerto de carga","en":"Charging port","ru":null}',
                'created_at' => '2022-12-23 06:47:53',
                'updated_at' => '2022-12-23 07:07:12',
            ),
            12 => 
            array (
                'id' => 14,
                'uuid' => '1671778084.62463a54f24985aa',
                'text' => '{"es":"Mi cesta","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:48:04',
                'updated_at' => '2022-12-23 06:48:04',
            ),
            13 => 
            array (
                'id' => 15,
                'uuid' => '1671778094.000163a54f2e0003e',
                'text' => '{"es":"Productos","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:48:14',
                'updated_at' => '2022-12-23 06:48:14',
            ),
            14 => 
            array (
                'id' => 16,
                'uuid' => '1671778113.107763a54f411a48e',
                'text' => '{"es":"Subtotal","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:48:33',
                'updated_at' => '2022-12-23 06:48:33',
            ),
            15 => 
            array (
                'id' => 17,
                'uuid' => '1671778118.665363a54f46a26e0',
                'text' => '{"es":"Envio","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:48:38',
                'updated_at' => '2022-12-23 06:48:38',
            ),
            16 => 
            array (
                'id' => 18,
                'uuid' => '1671778124.410863a54f4c644b1',
                'text' => '{"es":"Total","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:48:44',
                'updated_at' => '2022-12-23 06:48:44',
            ),
            17 => 
            array (
                'id' => 19,
                'uuid' => '1671778172.297963a54f7c48b8b',
                'text' => '{"es":"Env\\u00edos gratis a todos los pedidos superiores a 40 euros.","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:49:32',
                'updated_at' => '2022-12-23 06:49:32',
            ),
            18 => 
            array (
                'id' => 20,
                'uuid' => '1671778186.140263a54f8a22388',
                'text' => '{"es":"Tramitar","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:49:46',
                'updated_at' => '2022-12-23 06:49:46',
            ),
            19 => 
            array (
                'id' => 21,
                'uuid' => '1671778202.59763a54f9a91c12',
                'text' => '{"es":"Direcci\\u00f3n de envi\\u00f3","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:50:02',
                'updated_at' => '2022-12-23 06:50:02',
            ),
            20 => 
            array (
                'id' => 22,
                'uuid' => '1671778236.041763a54fbc0a2c2',
                'text' => '{"es":"Los envios solo est\\u00e1n disponibles para Espa\\u00f1a","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:50:36',
                'updated_at' => '2022-12-23 06:50:36',
            ),
            21 => 
            array (
                'id' => 23,
                'uuid' => '1671778245.187963a54fc52ddd1',
                'text' => '{"es":"Nombre","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:50:45',
                'updated_at' => '2022-12-23 06:50:45',
            ),
            22 => 
            array (
                'id' => 24,
                'uuid' => '1671778257.101163a54fd118b06',
                'text' => '{"es":"Apellidos","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:50:57',
                'updated_at' => '2022-12-23 06:50:57',
            ),
            23 => 
            array (
                'id' => 25,
                'uuid' => '1671778264.980663a54fd8ef652',
                'text' => '{"es":"Calle","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:51:04',
                'updated_at' => '2022-12-23 06:51:04',
            ),
            24 => 
            array (
                'id' => 26,
                'uuid' => '1671778276.172263a54fe42a0c0',
                'text' => '{"es":"C\\u00f3digo postal","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:51:16',
                'updated_at' => '2022-12-23 06:51:16',
            ),
            25 => 
            array (
                'id' => 27,
                'uuid' => '1671778283.100263a54feb18740',
                'text' => '{"es":"Ciudad","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:51:23',
                'updated_at' => '2022-12-23 06:51:23',
            ),
            26 => 
            array (
                'id' => 28,
                'uuid' => '1671778289.270963a54ff14225a',
                'text' => '{"es":"E-mal","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:51:29',
                'updated_at' => '2022-12-23 06:51:29',
            ),
            27 => 
            array (
                'id' => 29,
                'uuid' => '1671778301.918863a54ffde053e',
                'text' => '{"es":"Tel\\u00e9fono m\\u00f3vil","en":null,"ru":null}',
                'created_at' => '2022-12-23 06:51:41',
                'updated_at' => '2022-12-23 06:51:41',
            ),
            28 => 
            array (
                'id' => 30,
                'uuid' => '1671778311.168663a55007292cc',
                'text' => '{"es":"M\\u00e9todo pago","en":"Payment method","ru":null}',
                'created_at' => '2022-12-23 06:51:51',
                'updated_at' => '2022-12-23 07:06:54',
            ),
            29 => 
            array (
                'id' => 31,
                'uuid' => '1671778348.767963a5502cbb7b9',
                'text' => '{"es":"Nuestro Bot te proporciona la Url de pago tras haber completado el formulario","en":"Our Bot provides you with the payment URL after completing the form","ru":null}',
                'created_at' => '2022-12-23 06:52:28',
                'updated_at' => '2022-12-23 07:06:37',
            ),
            30 => 
            array (
                'id' => 32,
                'uuid' => '1671778365.810863a5503dc5f42',
                'text' => '{"es":"Pagar","en":"To pay","ru":null}',
                'created_at' => '2022-12-23 06:52:45',
                'updated_at' => '2022-12-23 07:06:26',
            ),
            31 => 
            array (
                'id' => 33,
                'uuid' => '1671778381.715663a5504daeb3a',
                'text' => '{"es":"Este campo es obligatorio","en":"This field is required","ru":null}',
                'created_at' => '2022-12-23 06:53:01',
                'updated_at' => '2022-12-23 07:06:11',
            ),
        ));
        
        
    }
}