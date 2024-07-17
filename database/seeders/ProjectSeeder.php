<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 時間取得のクラス
        $now = Carbon::now('Asia/Tokyo');

        $projects = [
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '第69回 全国肢体不自由児療育研究大会',
                'description' => '全国肢体不自由児療育研究大会 演題募集用',
                'status' => 0,
                'is_deadline' => $now,
                'mail_subject' => '「69回 全国肢体不自由児療育研究大会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第69回 全国肢体不自由児療育研究大会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '第31回 日本航空医療学会総会・学術集会',
                'description' => '日本航空医療学会総会・学術集会 演題募集用 メモ等',
                'status' => 1,
                'is_deadline' => $now,
                'mail_subject' => '「69回 全国肢体不自由児療育研究大会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第69回 全国肢体不自由児療育研究大会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '九州ブロック介護老人保健施設大会 美ら沖縄',
                'description' => '九州ブロック介護老人保健施設大会 サマーセミナー演題募集用',
                'status' => 0,
                'is_deadline' => $now,
                'mail_subject' => '「69回 全国肢体不自由児療育研究大会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第69回 全国肢体不自由児療育研究大会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => 'サマーセミナー in OKINAWA',
                'description' => '中頭病院 サマーセミナー演題募集用',
                'status' => 1,
                'is_deadline' => $now,
                'mail_subject' => '「69回 全国肢体不自由児療育研究大会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第69回 全国肢体不自由児療育研究大会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '日本ジェネリック医薬品・バイオシミラー学会',
                'description' => '日本ジェネリック医薬品・バイオシミラー学会 演題募集用',
                'status' => 1,
                'is_deadline' => $now,
                'mail_subject' => '「69回 全国肢体不自由児療育研究大会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第69回 全国肢体不自由児療育研究大会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('projects')->insert($projects);
    }
}
