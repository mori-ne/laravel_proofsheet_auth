<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            [
                "form_id" => 1,
                "inputType" => "textarea",
                "inputCode" => "code01",
                "inputTitle" => "テキストエリア（標準）",
                "inputLabel" => "テキストエリア（標準）のサブラベルがはいります2",
                "inputLimit" => 100,
                "inputContent" => "",
                "checkContent" => "",
                "radioContent" => "",
                "selectContent" => "",
                "isRequired" => false,
                "isOpen" => false,
            ],
            [
                "form_id" => 2,
                "inputType" => "text",
                "inputCode" => "code00",
                "inputTitle" => "テキスト（1行）",
                "inputLabel" => "テキスト（1行）のサブラベルがはいります1",
                "inputLimit" => 100,
                "inputContent" => "",
                "checkContent" => "",
                "radioContent" => "",
                "selectContent" => "",
                "isRequired" => false,
                "isOpen" => false,
            ],
        ];
        DB::table('inputs')->insert($inputs);
    }
}
