<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class InputSeeder extends Seeder
{
    public function run(): void
    {
        // JSONファイルのパス
        $jsonPath = database_path('json/sample.json');
        $json = File::get($jsonPath);

        $jsonPath2 = database_path('json/sample2.json');
        $json2 = File::get($jsonPath2);

        $jsonPath3 = database_path('json/sample3.json');
        $json3 = File::get($jsonPath3);

        // 時間取得のクラス
        $now = Carbon::now('Asia/Tokyo');

        $inputs = [
            [
                "form_id" => 1,
                "inputs" => $json3,
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "form_id" => 2,
                "inputs" => $json2,
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "form_id" => 3,
                "inputs" => null,
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "form_id" => 4,
                "inputs" => $json,
                "created_at" => $now,
                "updated_at" => $now,
            ],
        ];
        DB::table('input_json')->insert($inputs);
    }
}
