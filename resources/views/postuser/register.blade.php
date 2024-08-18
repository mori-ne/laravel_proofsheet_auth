@extends('postuser.layouts.master')
@section('title', 'アカウント本登録 | ' . $project->project_name)
@section('content')


    <div class="mx-auto max-w-2xl">

        <div class="mb-8">
            <h1 class="mb-4 text-lg font-bold">アカウント本登録</h1>
        </div>

        <div class="rounded border-0 bg-white p-10 shadow-lg shadow-neutral-200">

            <form action="{{ route('postuser.store', $uuid) }}" method="POST">
                @method('PUT')
                @csrf

                {{-- email --}}
                <div class="mb-16">
                    <div class="mb-4 border-b-2 border-neutral-200 pb-2">
                        <h6 class="font-bold text-neutral-700">メールアドレス</h6>
                        <p class="text-sm text-neutral-500">有効なメールアドレスを入力してください。</p>
                    </div>
                    <input name="email" type="email" class='w-full rounded border-0 bg-neutral-100 py-2 text-neutral-500' value="{{ $email }}" readonly>
                </div>

                {{-- name --}}
                <div class="mb-16">
                    <div class="mb-4 border-b-2 border-neutral-200 pb-2">
                        <h6 class="font-bold text-neutral-700">氏名情報</h6>
                        <p class="text-sm text-neutral-500">フルネームでご入力ください。</p>
                    </div>

                    <div class="flex flex-row gap-2">
                        <div class="flex-1">
                            <label class='mb-1.5 block text-sm font-bold text-neutral-700'>お名前（姓）<span class="pl-1 text-red-500">*</span></label>
                            <input name="first_name" type="text" class='w-full rounded border-0 bg-neutral-100 py-1.5 text-neutral-700' value="{{ old('first_name') }}">
                            @if ($errors->has('first_name'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('first_name') }}</p>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label class='mb-1.5 block text-sm font-bold text-neutral-700'>お名前（名）<span class="pl-1 text-red-500">*</span></label>
                            <input name="last_name" type="text" class='w-full rounded border-0 bg-neutral-100 py-1.5 text-neutral-700' value="{{ old('last_name') }}">
                            @if ($errors->has('last_name'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('last_name') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- affiliate --}}
                <div class="mb-16">
                    <div class="mb-4 border-b-2 border-neutral-200 pb-2">
                        <h6 class="font-bold text-neutral-700">所属情報</h6>
                        <p class="text-sm text-neutral-500">所属している企業、または住所を入力してください。</p>
                    </div>

                    <div class="mb-4 pb-2">
                        <div class="mb-4">
                            <label class='mb-1.5 block text-sm font-bold text-neutral-700'>所属施設名<span class="pl-1 text-red-500">*</span></label>
                            <input name="affiliate" type="text" class='w-full rounded border-0 bg-neutral-100 py-1.5 text-neutral-700' value="{{ old('affiliate') }}">
                            @if ($errors->has('affiliate'))
                                <p class="error mt-2 text-xs text-red-500">{{ $errors->first('affiliate') }}</p>
                            @endif
                        </div>

                        <postal-code-lookup></postal-code-lookup>
                        @if ($errors->has('zipcode'))
                            <p class="error mt-2 text-xs text-red-500">{{ $errors->first('zipcode') }}</p>
                        @endif
                    </div>
                </div>

                {{-- password --}}
                <div class="mb-16">
                    <div class="mb-4 border-b-2 border-neutral-200 pb-2">
                        <h6 class="font-bold text-neutral-700">パスワード<span class="pl-1 text-red-500">*</span></h6>
                        <p class="text-sm text-neutral-500">8文字以上で入力してください。</p>
                    </div>

                    {{-- password --}}
                    <input name="password" type="password" class='mb-4 w-full rounded border-0 bg-neutral-100 text-neutral-700' value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('password') }}</p>
                    @endif

                    {{-- retype password --}}
                    <label class='mb-2 block text-sm font-medium text-neutral-700'>パスワード（再入力）<span class="pl-1 text-red-500">*</span></label>
                    <input name="password_confirmation" type="password" class='w-full rounded border-0 bg-neutral-100 text-neutral-700' value="{{ old('password_confirmation') }}">
                    @if ($errors->has('password_confirmation'))
                        <p class="error mt-2 text-xs text-red-500">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="mt-6 flex items-center justify-center gap-6">
                    <button type="submit" class="min-w-48 flex items-center justify-center rounded-md bg-neutral-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 active:bg-neutral-900">新規登録する</button>
                </div>

            </form>

        </div>
    </div>
@endsection
