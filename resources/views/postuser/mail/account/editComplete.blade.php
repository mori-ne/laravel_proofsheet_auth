<div style="max-width: 600px; margin: 0 auto;">
    <br>
    <br>
    {{ $project_name }}よりお知らせ。<br>
    会員情報の更新が完了しました。<br>
    <br>
    <a href="{{ route('postuser.account', ['uuid' => $uuid]) }}">
        {{ route('postuser.account', ['uuid' => $uuid]) }}
    </a>
    <br>
    <br>
    もしお心当たりがない場合はこのままこのメールを破棄していただければ会員登録は行われません。<br>
    <br>
    ----------------------------------------------<br>
    {{ $project_name }} 事務局<br>
    TEL 000-0000-0000<br>
    FAX 000-0000-0000<br>
    E-mail example@example.jp<br>
    ----------------------------------------------
</div>
