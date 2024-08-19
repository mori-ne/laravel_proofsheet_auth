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
                'id' => 1,
                'project_id' => "1",
                'form_name' => '演題登録',
                'form_description' => '<p><b>■演題登録期間</b><br />～2024年7月31日（水）<br /><br />※締め切り直前はホームページへのアクセスが集中しますので、 演題登録に時間がかかることが予想されます。時間に余裕をもってご登録をお願いします。<br />※登録された演題のご修正につきましても上記期間内に行うようお願い致します。<br />（演題募集締切後の、演題の登録・確認・修正・削除の操作は一切できません。）予めご了承ください。<br /><br /><b>■字数制限</b><br />文字数︓2000文字<br />※表・図・写真を扱う方は、1点につき400文字を減じてください。<br />（例えば、図と表で2点の場合、本文は1200文字以内）<br />文字数はテキスト枠左下のカウントで確認できます。<br /><br /><b>■図表のアップロードについて</b><br />・表・図・写真は、本文の最後に表1・図1として掲載します。<br />・JPG,PNG,PDFのファイルがアップロードできます。（マイページからプレビューできるのはJPGとPNGのみになります）<br />・ファイル容量について…1つ最大2MBまで。<br />※1演題につきアップロードできる点数は、2点までとなっております。<br />※PDFにつきましては複数ページに渡るもののアップロードはご遠慮ください。 1ページのみの状態にしてアップロードをお願いいたします</p>',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'project_id' => "2",
                'form_name' => '演題登録',
                'form_description' => 'フォームの説明がはいります',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'project_id' => "2",
                'form_name' => '演題登録 2演題目',
                'form_description' => 'フォームの説明がはいります',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'project_id' => "2",
                'form_name' => '演題登録 3演題目',
                'form_description' => 'フォームの説明がはいります',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('forms')->insert($forms);
    }
}
