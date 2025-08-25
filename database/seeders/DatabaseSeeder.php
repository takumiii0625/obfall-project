<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            AdminsTableSeeder::class
            // 他のシーダーをここに追加
        );
        // \App\Models\User::factory(10)->create();
    }
}
