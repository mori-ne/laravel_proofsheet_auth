<div style="max-width: 600px; margin: 0 auto;">
    {{ $name }} 様<br>
    <br>
    {{ $project_name }}にご登録いただき、ありがとうございます。<br>
    会員登録が完了しました。<br>
    会員情報の変更等は管理画面から行えます。<br>
    <br>
    <a href="{{ route('postuser.dashboard', $uuid) }}">
        {{ route('postuser.dashboard', $uuid) }}
    </a>
    <br>
    <br>
    本メールに心当たりがない場合はこのままこのメールを破棄していただけますと幸いです。<br>
    <br>
    ----------------------------------------------<br>
    {{ $project_name }} 事務局<br>
    TEL 000-0000-0000<br>
    FAX 000-0000-0000<br>
    E-mail example@example.jp<br>
    ----------------------------------------------
</div>
