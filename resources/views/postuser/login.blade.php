@extends('postuser.layouts.master')
@section('title', 'ログイン | ' . $project->project_name)
@section('content')

    <div class="flex gap-4">

        {{-- content --}}
        <div class="documentstyle h-full rounded border border-gray-300 bg-white p-6">
            {!! $project->project_message !!}
        </div>

        {{-- registerd user --}}
        <div class="w-96 shrink-0">
            @error('login')
                <p class="text-sm text-red-500">※エラーです。</p>
            @enderror

            {{-- registerd --}}
            <div class="mb-4 rounded border border-gray-300 bg-white p-6">
                <h3 class="mb-6 border-l-4 border-orange-500 bg-gray-100 px-2 py-1 text-lg font-bold">
                    登録済の方はこちらから
                </h3>
                <form action="{{ route('postuser.login', ['uuid' => $project->uuid]) }}" method="POST">
                    @csrf
                    <div class="mb-8">
                        {{-- email --}}
                        <div class="mb-4">
                            <label class="mb-1 block text-sm" for="email">メールアドレス</label>
                            <input name="email" class="w-full rounded border border-gray-300" type="text" value="" placeholder="メールアドレス">
                        </div>
                        {{-- password --}}
                        <div class="mb-4">
                            <label class="mb-1 block text-sm" for="password">パスワード</label>
                            <input name="password" class="w-full rounded border border-gray-300" type="password" value="" placeholder="パスワード">
                        </div>
                        {{-- uuid --}}
                    </div>
                    <div class="mb-4">
                        <button class="w-full rounded bg-orange-500 py-2 font-bold text-white" type="submit">ログイン</button>
                    </div>
                    <p class="text-center text-sm text-orange-700">
                        <a class="underline" href="#">※パスワードをお忘れの方</a>
                    </p>
                </form>
            </div>

            {{-- newuser --}}
            <div class="mb-4 rounded border border-gray-300 bg-white p-6">
                <h3 class="mb-6 border-l-4 border-orange-500 bg-gray-100 px-2 py-1 text-lg font-bold">
                    初めてのかたはこちらから
                </h3>
                <div class="mb-4">
                    <form action="{{ route('postuser.register', $project->uuid) }}" method="GET">
                        <button class="w-full rounded bg-orange-500 py-2 font-bold text-white" type="submit">新規登録</button>
                    </form>
                </div>
            </div>

            {{-- information --}}
            <div class="rounded border border-gray-300 bg-white p-6">
                <h3 class="text-md mb-2 border-b border-gray-400 pb-1 font-bold">
                    {{ $project->project_name }}からのお知らせ
                </h3>
                <div class="mb-2">
                    <ul class="list-disc">
                        <li class="ml-4 text-sm text-gray-500">
                            2024年8月31日 2:00〜4:00にシステムメンテナンスを行います。<br>
                            それに伴い、上記の時間帯でのサービスを停止させていただきます。
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div>
        <p class="py-2 text-center text-sm text-gray-400">
            Created by morine
        </p>
    </div>

@endsection
