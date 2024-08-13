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
            'first_name' => 'Post',
            'last_name' => 'User',
            'affiliate' => '有限会社福琉印刷',
            'zipcode' => '9000012',
            'address_country' => '沖縄県',
            'address_city' => '那覇市泊',
            'address_etc' => '2-18-9 福琉印刷ビル',
            'email' => 'postuser@postuser.jp',
            'uuid' => '00000000-0000-0000-0000-000000000000'
        ]);

        PostUser::factory()->create([
            'first_name' => 'Post',
            'last_name' => 'User',
            'affiliate' => '有限会社福琉印刷',
            'zipcode' => '9000012',
            'address_country' => '沖縄県',
            'address_city' => '那覇市泊',
            'address_etc' => '2-18-9 福琉印刷ビル',
            'email' => 'postuser@postuser.jp',
            'uuid' => '00000000-0000-0000-0000-000000000001'
        ]);

        $this->call([
            ProjectSeeder::class,
            FormSeeder::class,
            InputSeeder::class,
        ]);
    }
}
