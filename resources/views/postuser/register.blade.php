@extends('postuser.layouts.master')
@section('title', 'アカウント本登録 | ' . $project->project_name)
@section('content')


    <div class="mx-auto max-w-xl">

        <div class="mb-8">
            <h1 class="mb-4 text-lg font-bold">アカウント本登録</h1>
        </div>

        <div class="rounded border border-gray-300 bg-white p-10">
            {{-- <form action="{{ route('postuser.register', $uuid) }}" method="POST"> --}}
            {{-- <form action="#" method="POST"> --}}
            {{-- @method('PUT') --}}
            @csrf

            <div class="mb-12">
                <!-- Email Address -->
                <div class="mb-8">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>メールアドレス</label>
                    <input name="email" type="email" class='w-full rounded border-0 border-gray-300 bg-gray-100 text-gray-500' value="{{ $email }}" readonly>
                </div>


                {{-- name --}}
                <div class="mb-8 flex flex-row gap-2">
                    <div class="flex flex-1 flex-col gap-2">
                        <label class='block text-sm font-medium text-gray-700'>お名前（姓）</label>
                        <input name="name_first" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('name_first') }}">
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label class='block text-sm font-medium text-gray-700'>お名前（名）</label>
                        <input name="name_last" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('name_last') }}">
                    </div>
                </div>

                <hr class="mb-8">

                {{-- 所属 --}}
                <div class="mb-8">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>所属</label>
                    <input name="affiliate" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('affiliate') }}">
                </div>

                {{-- 所属先住所 --}}
                <div class="mb-8">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>所属先住所</label>
                    <div class="mb-2 flex flex-row gap-2">
                        <div class="w-1/4">
                            <label class='mb-1 block text-xs font-medium text-gray-400'>郵便番号</label>
                            <input name="affiliate_zipcode" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('affiliate_zipcode') }}">

                            {{--  --}}
                            <postal-code-lookup></postal-code-lookup>

                        </div>
                        <div class="w-2/3">
                            <label class='mb-1 block text-xs font-medium text-gray-400'>都道府県</label>
                            <select name="affiliate_pref" id="affiliate_pref" class="rounded border border-gray-300">
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都">東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-2 w-full">
                        <label class='mb-1 block text-xs font-medium text-gray-400'>市町村</label>
                        <input name="affiliate_city" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('affiliate_city') }}">
                    </div>
                    <div class="w-full">
                        <label class='mb-1 block text-xs font-medium text-gray-400'>ほか住所（マンション名等）</label>
                        <input name="affiliate_etc" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('affiliate_etc') }}">
                    </div>
                </div>

                <hr class="mb-8">

                {{-- password --}}
                <div class="mb-2">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>パスワード</label>
                    <input name="password" type="password" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('password') }}">
                </div>

                {{-- retype password --}}
                <div class="mb-8">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>パスワード（再入力）</label>
                    <input name="retypepassword" type="password" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('retypepassword') }}">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-center gap-6">
                <button type="button" class="min-w-48 flex items-center justify-center rounded-md bg-gray-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">新規登録する</button>
            </div>

            </form>


        </div>
    </div>

@endsection
