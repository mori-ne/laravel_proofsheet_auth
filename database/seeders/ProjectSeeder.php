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
                'uuid' => '00000000-0000-0000-0000-000000000000',
                'project_name' => '第69回 全国肢体不自由児療育研究大会',
                'project_message' => '<h1><strong>お申し込み操作について</strong></h1> <h2><strong>初めてお申し込みをされる場合</strong></h2> <ol> <li><strong>「新規お申し込みはこちら」</strong>をクリックしていただき、「個人情報の取扱について」をご確認下さい。ご同意いただきましたら、「上記規約に同意します。」にチェックをし、「新規申込画面へ進む」をクリックして下さい。</li> <li>新規登録画面にて、申込代表者の情報を入力して下さい。<br>こちらでご登録いただいた、メールアドレスに申込完了後メールが自動送信されます。</li> <li>「次へ」をクリックし、参加者情報を入力後「確認画面へ」をクリックします。</li> <li>入力内容を確認し、「申し込む」をクリックして下さい。</li> </ol> <p><strong>※@mwt.co.jpからのメールが受信できるよう、予め設定をお願いいたします。<br></strong><strong>詳しい設定方法は、</strong><a href="https://www.mwt.co.jp/info/maillost.shtml?_ga=2.151019065.1075591117.1553408967-1568044973.1509270076" target="_blank" rel="noopener">こちら</a><strong>をご確認ください。【名鉄観光のホームページへ移動します】</strong></p> <h2><strong>2回目以降にログインする場合</strong></h2> <ol> <li>新規登録画面で登録したメールアドレスとパスワードを入力し、「ログイン」をクリックして下さい。</li> <li>パスワードをお忘れになった方は、ログインボタンの下にある<strong>『パスワードをお忘れの方</strong><strong>はこちら』</strong>をクリックしていただき、ご利用のメールアドレスを入力し、パスワード再設定のメールを請求してください。</li> </ol> <h2><strong>申込変更方法</strong></h2> <ol> <li>新規登録画面で登録したメールアドレスとパスワードを入力し、「ログイン」をクリックして下さい。</li> <li>申込担当者情報を変更する場合は、「申込者情報」タブをクリックしていただき、変更後、「保存」ボタンをクリックして下さい。</li> <li>参加者情報を変更する場合は、参加者名右端の、操作の「変更・取消」をクリックしていただき、変更後、「保存」ボタンをクリックして下さい。</li> </ol> <h2>&nbsp;</h2> <h2><strong>お申し込み締切日</strong></h2> <h3><strong>２０２４年７月３１日（水）１７：００まで</strong></h3> <h2>&nbsp;</h2> <h3><strong>参加費等のお支払いについて</strong></h3> <p>申込完了後自動送信されます「申込完了メール」に記載のお振込先へご入金をお願いいたします。</p> <ul> <li>お振込み手数料はお客様負担にてお願いいたします。</li> <li>領収書につきましては、原則、振込の控えをもって代えさせていただきます。</li> <li>別途領収書のご入用の方は、お申込の備考欄にご記載いただくか、大会当日弊社受付までお申出下さい。</li> </ul> <h3><strong>ご返金について</strong></h3> <p>お申し込み後の変更・取消によるご返金は、大会終了後に精算いたします。</p> <p>&nbsp;</p> <h3><strong>お問い合わせ先</strong></h3>  <p>名鉄観光サービス株式会社 沖縄支店<br>〒900-0032 沖縄県那覇市松山1-1-14 那覇共同ビル2F<br>TEL098-862-8211 FAX098-862-8212<br>営業時間：平日09:00～17:00 土日祝日休業<br>担当：原・前澤</p>',
                'project_description' => '全国肢体不自由児療育研究大会 演題募集用',
                'status' => 1,
                'is_deadline' => $now,
                'mail_subject' => '「69回 全国肢体不自由児療育研究大会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第69回 全国肢体不自由児療育研究大会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => '00000000-0000-0000-0000-000000000001',
                'project_name' => '第31回 日本航空医療学会総会・学術集会',
                'project_message' => '<h1>演題募集要項</h1><p>下記の演題区分に従って演題を募集いたします。<br>多くの皆様からのご登録をお待ち申し上げております。</p><h1>演題募集期間</h1><p>令和6年4月1日（月）～令和6年7月31日（水）</p><h1>応募資格</h1><ol><li>筆頭演者および共同演者は当学会員に限ります。未入会の方は必ず入会手続きをお願いいたします。</li><li>入会に関する詳細は、日本航空医療学会公式ウェブサイト内の「入会について」をご確認いただくか、当ページ下部の「日本航空医療学会への入会に関するお問い合わせ先」へお問い合わせください。<br>日本航空医療学会公式ウェブサイト&nbsp;<a href="https://jsas1994.jp/" target="_blank" rel="noopener">https://jsas1994.jp/</a></li><li>発表者が学生・初期研修医・消防機関などの防災機関職員・行政職員などの場合は、この限りではありませんが、その際には共同演者に当学会員が含まれる必要があります。応募前にご確認ください。</li></ol><div><h1>発表形式</h1><div><p>現地にてのPCプレゼンテーションをお願いする予定です。</p><h1>発表区分・登録カテゴリー</h1><div><p>演題の採否および発表区分については学会長にご一任下さい。</p><p>主要プログラムでご応募頂いても一般プログラムでのご発表をお願いする場合も、また一般プログラムでご応募頂いても主要プログラムでのご発表をお願いする場合もございます。予めご了承ください。</p></div><div><h1>日本航空医療学会への入会に関するお問い合わせ先</h1><div><h2>【日本航空医療学会】</h2><p>日本航空医療学会事務局<br>〒164-0001　東京都中野区中野2-2-3<br>へるす出版事業部内<br>TEL:03-3384-8042　FAX:03-3380-8627<br>E-mail:<a href="mailto:jsas@herusu-shuppan.co.jp">jsas@herusu-shuppan.co.jp</a></p><h1>演題登録に関するお問合せ先</h1><h2>【第31回 日本航空医療学会総会 運営事務局】</h2><p>株式会社アカネクリエーション　沖縄MICEサービス<br>〒900-0004 沖縄県那覇市銘苅1-9-29<br>TEL：098-862-8280<br>E-mail：<a href="mailto:jsas31@akane-ad.co.jp">jsas31@akane-ad.co.jp</a></p><div>&nbsp;</div></div>&nbsp;</div></div><div>&nbsp;</div></div>',
                'project_description' => '全国肢体不自由児療育研究大会 演題募集用',
                'status' => 1,
                'is_deadline' => $now,
                'mail_subject' => '「第31回 日本航空医療学会総会・学術集会」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「第31回 日本航空医療学会総会・学術集会」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '日本再生医療学会 第3回科学シンポジウム',
                'project_message' => '',
                'project_description' => '',
                'status' => 1,
                'is_deadline' => '2024-12-31:23:59:59',
                'mail_subject' => '「日本再生医療学会 第3回科学シンポジウム」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「日本再生医療学会 第3回科学シンポジウム」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => 'サマーセミナー in OKINAWA',
                'project_message' => '',
                'project_description' => '',
                'status' => 1,
                'is_deadline' => '2024-12-31:23:59:59',
                'mail_subject' => '「サマーセミナー in OKINAWA」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「サマーセミナー in OKINAWA」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '有限会社 福琉印刷',
                'project_message' => '',
                'project_description' => '',
                'status' => 1,
                'is_deadline' => '2024-12-31:23:59:59',
                'mail_subject' => '「有限会社 福琉印刷」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「有限会社 福琉印刷」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'uuid' => (string) Str::uuid(),
                'project_name' => '九州ブロック介護老人保健施設大会 美ら沖縄',
                'project_message' => '',
                'project_description' => '',
                'status' => 1,
                'is_deadline' => '2024-12-31:23:59:59',
                'mail_subject' => '「九州ブロック介護老人保健施設大会 美ら沖縄」演題登録 投稿受付通知',
                'mail_content' => '{$toName} 様<br><br><br>「九州ブロック介護老人保健施設大会 美ら沖縄」<br>演題のお申し込みをいただき誠にありがとうございます。<br><br>■投稿内容のご確認について<br>投稿された内容のご確認はマイページのプレビューにてご確認ください。<br><br>「ログイン」→「マイページ」→「投稿フォーム一覧」→「プレビュー」<br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br><br>マイページログインURL<br>https://www.proofsheet.jp/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/<br><br><br>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>※この送信元アドレスは配信専用となります。<br>本メールにご返信頂きましてもお答えできません。<br>※このメールにお心当たりのない方は、誠にお手数お掛けしますが、<br>下記サイト運営事務局までお問い合わせいただければ幸いです。<br><br>------------------------------------------------------------<br><br>演題登録運営事務局<br>(有)福琉印刷<br>〒900-0012 沖縄県那覇市泊2丁目19−8<br>TEL : 098-867-1989<br>E-mail : info@zenryoken-okinawa.jp<br>担当：親川<br><br>------------------------------------------------------------',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
