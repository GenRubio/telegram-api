<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfficePermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('office_permissions')->delete();
        
        \DB::table('office_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'crud_controller' => 'ApiClientCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:04',
                'updated_at' => '2022-12-30 14:15:04',
            ),
            1 => 
            array (
                'id' => 2,
                'crud_controller' => 'ApiClientCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:04',
                'updated_at' => '2022-12-30 14:15:04',
            ),
            2 => 
            array (
                'id' => 3,
                'crud_controller' => 'ApiClientCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            3 => 
            array (
                'id' => 4,
                'crud_controller' => 'ApiClientCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            4 => 
            array (
                'id' => 5,
                'crud_controller' => 'BotCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            5 => 
            array (
                'id' => 6,
                'crud_controller' => 'BotCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            6 => 
            array (
                'id' => 7,
                'crud_controller' => 'BotCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            7 => 
            array (
                'id' => 8,
                'crud_controller' => 'BotCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            8 => 
            array (
                'id' => 9,
                'crud_controller' => 'BotTranslationCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            9 => 
            array (
                'id' => 10,
                'crud_controller' => 'BotTranslationCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            10 => 
            array (
                'id' => 11,
                'crud_controller' => 'BotTranslationCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            11 => 
            array (
                'id' => 12,
                'crud_controller' => 'BotTranslationCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            12 => 
            array (
                'id' => 13,
                'crud_controller' => 'BrandCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            13 => 
            array (
                'id' => 14,
                'crud_controller' => 'BrandCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            14 => 
            array (
                'id' => 15,
                'crud_controller' => 'BrandCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            15 => 
            array (
                'id' => 16,
                'crud_controller' => 'BrandCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            16 => 
            array (
                'id' => 17,
                'crud_controller' => 'CustomerCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            17 => 
            array (
                'id' => 18,
                'crud_controller' => 'CustomerCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            18 => 
            array (
                'id' => 19,
                'crud_controller' => 'CustomerCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            19 => 
            array (
                'id' => 20,
                'crud_controller' => 'CustomerCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            20 => 
            array (
                'id' => 21,
                'crud_controller' => 'LanguageCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            21 => 
            array (
                'id' => 22,
                'crud_controller' => 'LanguageCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            22 => 
            array (
                'id' => 23,
                'crud_controller' => 'LanguageCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            23 => 
            array (
                'id' => 24,
                'crud_controller' => 'LanguageCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            24 => 
            array (
                'id' => 25,
                'crud_controller' => 'OfficePermissionCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            25 => 
            array (
                'id' => 26,
                'crud_controller' => 'OfficePermissionCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            26 => 
            array (
                'id' => 27,
                'crud_controller' => 'OfficePermissionCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            27 => 
            array (
                'id' => 28,
                'crud_controller' => 'OfficePermissionCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            28 => 
            array (
                'id' => 29,
                'crud_controller' => 'OrderCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            29 => 
            array (
                'id' => 30,
                'crud_controller' => 'OrderCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            30 => 
            array (
                'id' => 31,
                'crud_controller' => 'OrderCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            31 => 
            array (
                'id' => 32,
                'crud_controller' => 'OrderCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            32 => 
            array (
                'id' => 33,
                'crud_controller' => 'OrderProductCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:05',
                'updated_at' => '2022-12-30 14:15:05',
            ),
            33 => 
            array (
                'id' => 34,
                'crud_controller' => 'OrderProductCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            34 => 
            array (
                'id' => 35,
                'crud_controller' => 'OrderProductCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            35 => 
            array (
                'id' => 36,
                'crud_controller' => 'OrderProductCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            36 => 
            array (
                'id' => 37,
                'crud_controller' => 'ProductModelCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            37 => 
            array (
                'id' => 38,
                'crud_controller' => 'ProductModelCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            38 => 
            array (
                'id' => 39,
                'crud_controller' => 'ProductModelCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            39 => 
            array (
                'id' => 40,
                'crud_controller' => 'ProductModelCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            40 => 
            array (
                'id' => 41,
                'crud_controller' => 'ProductModelsFlavorCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            41 => 
            array (
                'id' => 42,
                'crud_controller' => 'ProductModelsFlavorCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            42 => 
            array (
                'id' => 43,
                'crud_controller' => 'ProductModelsFlavorCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            43 => 
            array (
                'id' => 44,
                'crud_controller' => 'ProductModelsFlavorCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            44 => 
            array (
                'id' => 45,
                'crud_controller' => 'SettingCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            45 => 
            array (
                'id' => 46,
                'crud_controller' => 'SettingCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            46 => 
            array (
                'id' => 47,
                'crud_controller' => 'SettingCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            47 => 
            array (
                'id' => 48,
                'crud_controller' => 'SettingCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            48 => 
            array (
                'id' => 49,
                'crud_controller' => 'TelegramBotMessageCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            49 => 
            array (
                'id' => 50,
                'crud_controller' => 'TelegramBotMessageCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            50 => 
            array (
                'id' => 51,
                'crud_controller' => 'TelegramBotMessageCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            51 => 
            array (
                'id' => 52,
                'crud_controller' => 'TelegramBotMessageCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            52 => 
            array (
                'id' => 53,
                'crud_controller' => 'TranslationCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            53 => 
            array (
                'id' => 54,
                'crud_controller' => 'TranslationCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            54 => 
            array (
                'id' => 55,
                'crud_controller' => 'TranslationCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            55 => 
            array (
                'id' => 56,
                'crud_controller' => 'TranslationCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            56 => 
            array (
                'id' => 57,
                'crud_controller' => 'UserCrudController',
                'name' => 'show',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            57 => 
            array (
                'id' => 58,
                'crud_controller' => 'UserCrudController',
                'name' => 'create',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            58 => 
            array (
                'id' => 59,
                'crud_controller' => 'UserCrudController',
                'name' => 'update',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            59 => 
            array (
                'id' => 60,
                'crud_controller' => 'UserCrudController',
                'name' => 'delete',
                'created_at' => '2022-12-30 14:15:06',
                'updated_at' => '2022-12-30 14:15:06',
            ),
            60 => 
            array (
                'id' => 61,
                'crud_controller' => 'TelegramBotGlobalMessageCrudController',
                'name' => 'show',
                'created_at' => '2023-01-02 14:26:01',
                'updated_at' => '2023-01-02 14:26:01',
            ),
            61 => 
            array (
                'id' => 62,
                'crud_controller' => 'TelegramBotGlobalMessageCrudController',
                'name' => 'create',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            62 => 
            array (
                'id' => 63,
                'crud_controller' => 'TelegramBotGlobalMessageCrudController',
                'name' => 'update',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            63 => 
            array (
                'id' => 64,
                'crud_controller' => 'TelegramBotGlobalMessageCrudController',
                'name' => 'delete',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            64 => 
            array (
                'id' => 65,
                'crud_controller' => 'TelegramBotGroupCrudController',
                'name' => 'show',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            65 => 
            array (
                'id' => 66,
                'crud_controller' => 'TelegramBotGroupCrudController',
                'name' => 'create',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            66 => 
            array (
                'id' => 67,
                'crud_controller' => 'TelegramBotGroupCrudController',
                'name' => 'update',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            67 => 
            array (
                'id' => 68,
                'crud_controller' => 'TelegramBotGroupCrudController',
                'name' => 'delete',
                'created_at' => '2023-01-02 14:26:02',
                'updated_at' => '2023-01-02 14:26:02',
            ),
            68 => 
            array (
                'id' => 69,
                'crud_controller' => 'GeocodingApiCrudController',
                'name' => 'show',
                'created_at' => '2023-01-09 18:57:41',
                'updated_at' => '2023-01-09 18:57:41',
            ),
            69 => 
            array (
                'id' => 70,
                'crud_controller' => 'GeocodingApiCrudController',
                'name' => 'create',
                'created_at' => '2023-01-09 18:57:41',
                'updated_at' => '2023-01-09 18:57:41',
            ),
            70 => 
            array (
                'id' => 71,
                'crud_controller' => 'GeocodingApiCrudController',
                'name' => 'update',
                'created_at' => '2023-01-09 18:57:41',
                'updated_at' => '2023-01-09 18:57:41',
            ),
            71 => 
            array (
                'id' => 72,
                'crud_controller' => 'GeocodingApiCrudController',
                'name' => 'delete',
                'created_at' => '2023-01-09 18:57:41',
                'updated_at' => '2023-01-09 18:57:41',
            ),
        ));
        
        
    }
}