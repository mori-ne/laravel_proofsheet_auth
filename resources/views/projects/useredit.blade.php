@extends('layouts.master')
@section('title', 'ユーザー情報の編集')
@section('content')

    {{-- top --}}
    @include('layouts.topbar')

    <div class="flex flex-row flex-nowrap">

        {{-- sidebar --}}
        @include('layouts.sidebar')

        <div class="mx-auto h-[calc(100svh_-_56px)] w-full overflow-y-scroll p-6">
            {{-- content --}}
            <form action="{{ route('projects.userStore', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4 w-full rounded border border-neutral-200 bg-white">
                    {{-- title --}}
                    <div class="border-b border-neutral-200 px-4 py-3">
                        <p class="text-sm font-bold text-neutral-500">ユーザーの詳細</p>
                    </div>

                    {{-- content --}}
                    <div class="px-4 pt-6">

                        {{-- 登録プロジェクト --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">登録プロジェクト</label>
                            </div>
                            <div>
                                <p class="text-lg">{{ $project->project_name }}</p>
                            </div>
                        </div>

                        <hr class="mb-6">

                        {{-- ユーザー名 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">ユーザー名</label>
                            </div>
                            <div class="flex flex-row gap-4">
                                <p class="mb-4 w-full">
                                    <input name="first_name" type="text" placeholder="プロジェクト名を記入してください" value="{{ $user->first_name }}" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" />
                                    @if ($errors->has('first_name'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('first_name') }}</p>
                                    @endif
                                </p>
                                <p class="mb-4 w-full">
                                    <input name="last_name" type="text" placeholder="プロジェクト名を記入してください" value="{{ $user->last_name }}" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" />
                                    @if ($errors->has('last_name'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('last_name') }}</p>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr class="mb-6">

                        {{-- 住所情報 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">住所情報</label>
                            </div>
                            <div>
                                <p class="mb-4">
                                    <input name="affiliate" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->affiliate }}">
                                    @if ($errors->has('affiliate'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('affiliate') }}</p>
                                    @endif
                                </p>
                                <p class="mb-4">
                                    <input name="zipcode" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->zipcode }}">
                                    @if ($errors->has('zipcode'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('zipcode') }}</p>
                                    @endif
                                </p>
                                <p class="mb-4">
                                    <input name="address_country" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->address_country }}">
                                    @if ($errors->has('address_country'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('address_country') }}</p>
                                    @endif
                                </p>
                                <p class="mb-4">
                                    <input name="address_city" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->address_city }}">
                                    @if ($errors->has('address_city'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('address_city') }}</p>
                                    @endif
                                </p>
                                <p class="mb-4">
                                    <input name="address_etc" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->address_etc }}">
                                    @if ($errors->has('address_etc'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('address_etc') }}</p>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr class="mb-6">

                        {{-- パスワード --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">パスワード</label>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <p>現在のパスワード</p>
                                    <input name="old_password" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->old_password }}">
                                    @if ($errors->has('old_password'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('old_password') }}</p>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <p>新しいパスワード</p>
                                    <input name="new_password" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->new_password }}">
                                    @if ($errors->has('new_password'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('new_password') }}</p>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <p>新しいパスワード（再入力）</p>
                                    <input name="retype_password" type="text" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" value="{{ $user->retype_password }}">
                                    @if ($errors->has('retype_password'))
                                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('retype_password') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="mb-6">

                        {{-- 作成・変更日 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">作成・変更日</label>
                            </div>
                            <div>
                                <p>作成日</p>
                                <input name="created_at" type="datetime-local" value="{{ $user->created_at }}">
                                @if ($errors->has('created_at'))
                                    <p class="error mt-2 text-xs text-red-500">{{ $errors->first('created_at') }}</p>
                                @endif
                            </div>
                            <div>
                                <p>更新日</p>
                                <input name="updated_at" type="datetime-local" value="{{ $user->updated_at }}">
                                @if ($errors->has('updated_at'))
                                    <p class="error mt-2 text-xs text-red-500">{{ $errors->first('updated_at') }}</p>
                                @endif
                            </div>
                        </div>

                        <button type="submit"
                            class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">更新する</button>
                    </div>
                </div>
            </form>
        </div>

        <div>
            <span class="pr-4 text-xs text-neutral-400">
                プロジェクト作成日：

            </span>
            <span class="pr-4 text-xs text-neutral-400">
                プロジェクト更新日：

            </span>
        </div>


    </div>
@endsection
