<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(BrandsTableSeeder::class);
        $this->call(TelegraphBotsTableSeeder::class);
        $this->call(TelegraphChatsTableSeeder::class);
        $this->call(ProductModelsTableSeeder::class);
        $this->call(ProductModelsFlavorsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TelegramBotMessagesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
    }
}
