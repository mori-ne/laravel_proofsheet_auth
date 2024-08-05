<?php

namespace Database\Seeders;

use App\Models\PostUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'rootuser@rootuser.jp',
        ]);

        PostUser::factory()->create([
            'name' => 'Test User',
            'email' => 'postuser@postuser.jp',
        ]);

        $this->call([
            ProjectSeeder::class,
            FormSeeder::class,
            InputSeeder::class,
        ]);
    }
}
