@extends('postuser.layouts.master')
@section('title', 'ダッシュボード | ' . $project->project_name)
@section('content')
    <div class="mx-auto max-w-2xl flex-row justify-center">
        <div class="w-full py-10">
            <div class="h-full rounded-md border-0 bg-white p-8 shadow-md shadow-neutral-100">
                <h4 class="mb-4 text-lg font-bold text-neutral-700">アカウント情報</h4>

                <form action="{{ route('postuser.account.edit.name', $uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- name --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">氏名情報</h5>
                        <div class="flex flex-row gap-4">
                            <div class="w-full">
                                <label class="mb-1 block text-sm text-neutral-700" for="first_name">お名前（姓）</label>
                                <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="first_name" value="{{ Auth::guard('postuser')->user()->first_name }}">
                                @if ($errors->has('first_name'))
                                    <p class="error mt-2 text-xs text-red-500">{{ $errors->first('first_name') }}</p>
                                @endif
                            </div>
                            <div class="w-full">
                                <label class="mb-1 block text-sm text-neutral-700" for="first_name">お名前（名）</label>
                                <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="last_name" value="{{ Auth::guard('postuser')->user()->last_name }}">
                                @if ($errors->has('last_name'))
                                    <p class="error mt-2 text-xs text-red-500">{{ $errors->first('last_name') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- affiliate --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">所属情報</h5>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="affiliate">ご所属</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="affiliate" value="{{ Auth::guard('postuser')->user()->affiliate }}">
                            @if ($errors->has('affiliate'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('affiliate') }}</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="zipcode">郵便番号</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="zipcode" value="{{ Auth::guard('postuser')->user()->zipcode }}">
                            @if ($errors->has('zipcode'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('zipcode') }}</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="address">住所</label>
                            <div class="flex flex-row gap-4">
                                <div class="mb-4 w-full">
                                    <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="address_country" value="{{ Auth::guard('postuser')->user()->address_country }}">
                                    @if ($errors->has('address_country'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('address_country') }}</p>
                                    @endif
                                </div>
                                <div class="mb-4 w-full">
                                    <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="address_city" value="{{ Auth::guard('postuser')->user()->address_city }}">
                                    @if ($errors->has('address_city'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('address_city') }}</p>
                                    @endif
                                </div>
                            </div>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="text" name="address_etc" value="{{ Auth::guard('postuser')->user()->address_etc }}">
                            @if ($errors->has('address_etc'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('address_etc') }}</p>
                            @endif
                        </div>

                        <button class="flex items-center justify-center rounded bg-neutral-700 px-3 py-2 text-sm font-bold text-white" type="submit">氏名・所属を変更する</button>
                    </div>
                </form>

                <hr class="mb-8">

                <form action="{{ route('postuser.account.edit.mail', $uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- email --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">メールアドレス</h5>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="first_name">メールアドレス</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="email" name="email" value="{{ Auth::guard('postuser')->user()->email }}">
                        </div>
                        <button class="flex items-center justify-center rounded bg-neutral-700 px-3 py-2 text-sm font-bold text-white" type="submit">メールアドレスを変更する</button>
                    </div>
                </form>

                <hr class="mb-8">

                <form action="{{ route('postuser.account.edit.password', $uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- password --}}
                    <div class="mb-12">
                        <h5 class="text-md mb-4 font-bold text-neutral-500">パスワード</h5>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="old_password">以前のパスワード</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="old_password" value="">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="new_password">新しいパスワード</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="new_password" value="">
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="retype_password">新しいパスワード（再入力）</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="retype_password" value="">
                        </div>
                        <button class="flex items-center justify-center rounded bg-neutral-700 px-3 py-2 text-sm font-bold text-white" type="submit">パスワードを変更する</button>
                    </div>
                </form>

                <hr class="mb-8">

                {{-- <form action="{{ route('postuser.account.edit.delete', $uuid) }}" method="POST"> --}}
                @csrf
                @method('delete')
                {{-- delete --}}
                <div x-data="{ open: false }">
                    <button x-on:click="open = true" class="text-sm text-red-500">アカウントを削除</button>
                    <div x-show="open">
                        a
                    </div>
                    {{-- <a href="{{ route('postuser.account.edit.delete', $uuid) }}" class="text-sm text-red-500">アカウントを削除</a> --}}
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
@endsection
