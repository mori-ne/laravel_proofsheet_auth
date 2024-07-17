<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 時間取得のクラス
        $now = Carbon::now('Asia/Tokyo');

        $forms = [
            [
                'project_id' => "1",
                'form_name' => '演題登録',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'project_id' => "1",
                'form_name' => '演題登録 2演題目',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'project_id' => "1",
                'form_name' => '演題登録 3演題目',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'project_id' => "2",
                'form_name' => '演題登録',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('forms')->insert($forms);
    }
}
