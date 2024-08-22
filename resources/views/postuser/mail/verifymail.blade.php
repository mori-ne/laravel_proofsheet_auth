<div style="max-width: 600px; margin: 0 auto;">
    ※本メールは自動配信メールです。<br>
    <br>
    {{ $email }} 様<br>
    <br>
    {{ $project_name }}にご登録いただき、ありがとうございます。<br>
    本会員登録を完了するには下記URLからメールを認証してください。<br>
    有効期限は24時間です。24時間以内に登録を完了してください。
    <br>
    <br>
    <a href="{{ route('postuser.verifiedmailsignup', ['uuid' => $uuid, 'token' => $token]) }}">
        {{ route('postuser.verifiedmailsignup', ['uuid' => $uuid, 'token' => $token]) }}
    </a>
    <br>
    <br>
    本メールに心当たりがない場合はこのままこのメールを破棄していただけますと幸いです。 <br>
    ----------------------------------------------<br>
    {{ $project_name }} 事務局<br>
    TEL 000-0000-0000<br>
    FAX 000-0000-0000<br>
    E-mail example@example.jp<br>
    ----------------------------------------------
</div>
