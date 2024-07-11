<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 時間取得のクラス
        $now = Carbon::now();

        $projects = [
            [
                'project_name' => '第69回 全国肢体不自由児療育研究大会',
                'description' => '全国肢体不自由児療育研究大会 演題募集用',
                'status' => 0,
                'is_deadline' => $now,
            ],
            [
                'project_name' => '第31回 日本航空医療学会総会・学術集会',
                'description' => '日本航空医療学会総会・学術集会 演題募集用 メモ等',
                'status' => 1,
                'is_deadline' => $now,

            ],
            [
                'project_name' => '九州ブロック介護老人保健施設大会 美ら沖縄',
                'description' => '九州ブロック介護老人保健施設大会 サマーセミナー演題募集用',
                'status' => 0,
                'is_deadline' => $now,

            ],
            [
                'project_name' => 'サマーセミナー in OKINAWA',
                'description' => '中頭病院 サマーセミナー演題募集用',
                'status' => 1,
                'is_deadline' => $now,

            ],
            [
                'project_name' => '日本ジェネリック医薬品・バイオシミラー学会',
                'description' => '日本ジェネリック医薬品・バイオシミラー学会 演題募集用',
                'status' => 1,
                'is_deadline' => $now,

            ]
        ];

        DB::table('projects')->insert($projects);
    }
}
