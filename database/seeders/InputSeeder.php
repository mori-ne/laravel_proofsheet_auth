<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InputSeeder extends Seeder
{
    public function run(): void
    {

        // JSONファイルのパス
        $jsonFilePath = base_path('database/seeders/sample.json');

        // JSONファイルが存在することを確認
        if (!File::exists($jsonFilePath)) {
            throw new \Exception('JSON file not found.');
        }

        // JSONファイルの内容を取得
        $jsonData = File::get($jsonFilePath);

        // JSONデータをデコード
        $data = json_decode($jsonData, true);

        // データが正しくデコードされているか確認
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error decoding JSON data.');
        }

        // データベースにデータを挿入
        DB::table('forms')->insert($data);

        // $inputs = [
        //     [
        //         "form_id" => 1,
        //         "inputType" => "textarea",
        //         "inputCode" => "code01",
        //         "inputTitle" => "テキストエリア（標準）",
        //         "inputLabel" => "テキストエリア（標準）のサブラベルがはいります2",
        //         "inputLimit" => 100,
        //         "inputContent" => "",
        //         "checkContent" => "",
        //         "radioContent" => "",
        //         "selectContent" => "",
        //         "isRequired" => false,
        //         "isOpen" => false,
        //     ],
        //     [
        //         "form_id" => 2,
        //         "inputType" => "text",
        //         "inputCode" => "code00",
        //         "inputTitle" => "テキスト（1行）",
        //         "inputLabel" => "テキスト（1行）のサブラベルがはいります1",
        //         "inputLimit" => 100,
        //         "inputContent" => "",
        //         "checkContent" => "",
        //         "radioContent" => "",
        //         "selectContent" => "",
        //         "isRequired" => false,
        //         "isOpen" => false,
        //     ],
        // ];
        // DB::table('inputs')->insert($inputs);
    }
}
