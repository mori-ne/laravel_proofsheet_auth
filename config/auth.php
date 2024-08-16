<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 認証のデフォルト
    |--------------------------------------------------------------------------
    |
    | このオプションは、アプリケーションのデフォルトの認証「ガード」とパスワードリセット「ブローカー」を定義します。
    | これらの値は必要に応じて を変更することもできますが、ほとんどのアプリケーションではこの値から始めるのがよいでしょう。
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | 認証ガード
    |--------------------------------------------------------------------------
    |
    | 次に、アプリケーションの各認証ガードを定義することができる。
    | もちろん、セッションストレージとEloquentユーザープロバイダーを利用するすばらしいデフォルト設定が定義されています。
    |
    | すべての認証ガードにはユーザプロバイダがあり、アプリケーションで使用するデータベースやその他のストレージシステムからユーザを実際に取得する方法を定義します。
    | 通常、Eloquentが利用されます。
    |
    | サポートされている 「セッション」
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'postuser' => [
            'driver' => 'session',
            'provider' => 'postusers'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ユーザープロバイダー
    |--------------------------------------------------------------------------
    |
    | すべての認証ガードにはユーザ・プロバイダがあり、アプリケーションで使用されるデータベースや
    | その他のストレージ・システムからユーザを実際に取り出す方法を定義します。通常、Eloquentが利用されます。
    |
    | 複数のユーザテーブルやモデルがある場合、モデルやテーブルを表すために複数のプロバイダを設定することができます。
    | これらのプロバイダは、定義した認証ガードに割り当てることができます。
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'postusers' => [
            'driver' => 'eloquent',
            'model' => App\Models\PostUser::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | パスワードのリセット
    |--------------------------------------------------------------------------
    |
    | これらの設定オプションは、トークンの保存に使用されるテーブルや、実際にユーザーを取得するために呼び出されるユーザープロバイダーなど、
    | Laravelのパスワードリセット機能の動作を指定します。
    |
    | 有効期限は、各リセット・トークンが有効とみなされる分数です。
    | このセキュリティ機能により、トークンは短命に保たれ、推測される時間が短くなります。必要に応じて変更してください。
    |
    | スロットル設定は、ユーザがさらにパスワード リセット トークンを生成する前に待機しなければならない秒数です。
    | これにより、ユーザが非常に大量のパスワード・リセット・トークンを素早く生成するのを防ぐことができます。
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'postusers' => [
            'provider' => 'postusers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | パスワード確認タイムアウト
    |--------------------------------------------------------------------------
    |
    | ここでは、パスワード確認ウィンドウの有効期限が切れ、ユーザーに確認画面でパスワードの再入力を求めるまでの秒数を定義することができます。
    | デフォルトでは、タイムアウトは3時間です。
    |
    */

    'password_timeout' => 10800,

];
