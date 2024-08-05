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
            'name' => 'Post User',
            'email' => 'postuser@postuser.jp',
            'uuid' => '00000000-0000-0000-0000-000000000000'
        ]);

        $this->call([
            ProjectSeeder::class,
            FormSeeder::class,
            InputSeeder::class,
        ]);
    }
}
