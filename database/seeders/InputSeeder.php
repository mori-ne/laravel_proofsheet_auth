<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InputSeeder extends Seeder
{
    public function run(): void
    {

        // 時間取得のクラス
        $now = Carbon::now('Asia/Tokyo');

        $inputs = [
            [
                "form_id" => 1,
                "inputs" => null,
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "form_id" => 2,
                "inputs" => null,
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "form_id" => 3,
                "inputs" => null,
                "created_at" => $now,
                "updated_at" => $now,
            ]
        ];
        DB::table('input_json')->insert($inputs);
    }
}
