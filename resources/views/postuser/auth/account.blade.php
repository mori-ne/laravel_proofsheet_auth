@extends('postuser.layouts.master')
@section('title', 'ダッシュボード | ' . $project->project_name)
@section('content')
    <div class="mx-auto max-w-2xl flex-row justify-center">
        <div class="w-full py-10">
            <div class="h-full rounded-md border-0 bg-white p-8 shadow-md shadow-neutral-100">
                <h4 class="mb-4 text-lg font-bold text-neutral-700">アカウント情報</h4>

                <form action="#">

                    {{-- name --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">氏名情報</h5>
                        <div class="flex flex-row gap-4">
                            <div class="w-full">
                                <label class="mb-1 block text-sm text-neutral-700" for="first_name">お名前（姓）</label>
                                <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="first_name" value="{{ Auth::guard('postuser')->user()->first_name }}">
                            </div>
                            <div class="w-full">
                                <label class="mb-1 block text-sm text-neutral-700" for="first_name">お名前（名）</label>
                                <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="last_name" value="{{ Auth::guard('postuser')->user()->last_name }}">
                            </div>
                        </div>
                    </div>

                    {{-- affiliate --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">所属情報</h5>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">ご所属</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="affiliate" value="{{ Auth::guard('postuser')->user()->affiliate }}">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">郵便番号</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="zipcode" value="{{ Auth::guard('postuser')->user()->zipcode }}">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">住所</label>
                            <div class="flex flex-row gap-4">
                                <div class="mb-4 w-full">
                                    <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="address_country" value="{{ Auth::guard('postuser')->user()->address_country }}">
                                </div>
                                <div class="mb-4 w-full">
                                    <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="address_city" value="{{ Auth::guard('postuser')->user()->address_city }}">
                                </div>
                            </div>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="address_etc" value="{{ Auth::guard('postuser')->user()->address_etc }}">
                        </div>
                    </div>

                    {{-- email --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">メールアドレス</h5>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">メールアドレス</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="email" name="email" value="{{ Auth::guard('postuser')->user()->email }}">
                        </div>
                        <button class="flex items-center justify-center rounded bg-neutral-700 px-3 py-2 text-sm font-bold text-white" type="button" >メールアドレスを変更する</button>
                    </div>

                    {{-- password --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">パスワード</h5>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">以前のパスワード</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="password" value="">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">新しいパスワード</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="password" value="">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">新しいパスワード（再入力）</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="retype_password" value="">
                        </div>
                        <button class="flex items-center justify-center rounded bg-neutral-700 px-3 py-2 text-sm font-bold text-white" type="button" >パスワードを変更する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
