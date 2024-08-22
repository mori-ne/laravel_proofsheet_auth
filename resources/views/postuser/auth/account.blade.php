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
                        <h5 class="mb-4 text-lg font-bold text-neutral-500">氏名情報</h5>
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

                    <hr class="mb-8">

                    {{-- affiliate --}}
                    <div class="mb-12">
                        <h5 class="mb-4 text-lg font-bold text-neutral-500">所属情報</h5>
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
                        <h5 class="text-lg font-bold text-neutral-500">メールアドレス</h5>
                        <p class="mb-6 text-sm text-neutral-400">変更にはメールアドレスの再認証が必要です。<br>変更ボタンを押した後に届いたメールから再認証をお願いいたします</p>

                        <div class="mb-4">
                            {{-- <label class="mb-1 block text-sm text-neutral-700" for="first_name">メールアドレス</label> --}}
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
                        <h5 class="text-lg font-bold text-neutral-500">パスワード</h5>
                        <p class="mb-6 text-sm text-neutral-400">パスワードの変更後は再ログインが必要です</p>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="old_password">現在のパスワード</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="old_password" value="">
                            @if ($errors->has('old_password'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('old_password') }}</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="new_password">新しいパスワード</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="new_password" value="">
                            @if ($errors->has('new_password'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('new_password') }}</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block text-sm text-neutral-700" for="retype_new_password">新しいパスワード（再入力）</label>
                            <input class="w-full rounded border-0 bg-neutral-100 shadow-inner" type="password" name="retype_new_password" value="">
                            @if ($errors->has('retype_new_password'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('retype_new_password') }}</p>
                            @endif
                        </div>
                        <button class="flex items-center justify-center rounded bg-neutral-700 px-3 py-2 text-sm font-bold text-white" type="submit">パスワードを変更する</button>
                    </div>
                </form>

                <hr class="mb-8">

                {{-- delete --}}
                <div x-data="{ open: false }">

                    <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" :class="{ 'z-40': modalOpen }" class="relative h-auto w-auto">
                        <button @click="modalOpen=true"
                            class="hover:bg-neutral-10 inline-flex h-10 items-center justify-center rounded-md border-0 bg-white px-4 py-2 text-sm font-medium text-red-500 transition-colors focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50">アカウントを削除</button>
                        <template x-teleport="body">
                            <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-white bg-opacity-70 backdrop-blur-sm"></div>
                                <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                                    class="relative w-full border border-neutral-200 bg-white px-7 py-6 shadow-lg sm:max-w-lg sm:rounded-lg">
                                    <div class="flex items-center justify-between pb-3">
                                        <h3 class="text-lg font-semibold">アカウントを削除</h3>
                                        <button @click="modalOpen=false" class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 hover:bg-gray-50 hover:text-gray-800">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative w-auto pb-8">
                                        <p>アカウントを削除します。本当によろしいですか？</p>
                                        <p class="text-sm text-red-500">※この操作は取り消せません。</p>
                                    </div>
                                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                                        <button @click="modalOpen=false" type="button" class="inline-flex h-10 items-center justify-center rounded-md border px-4 py-2 text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">キャンセル</button>
                                        <form action="{{ route('postuser.account.edit.delete', $uuid) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ Auth::guard('postuser')->user()->id }}">
                                            <button @click="modalOpen=false" type="submit"
                                                class="inline-flex h-10 items-center justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-900 focus:ring-offset-2">アカウントを削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    {{-- <a href="{{ route('postuser.account.edit.delete', $uuid) }}" class="text-sm text-red-500">アカウントを削除</a> --}}
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
@endsection
