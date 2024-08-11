@extends('postuser.layouts.master')
@section('title', 'アカウント新規登録 | ' . $project->project_name)
@section('content')


    <div class="mx-auto max-w-xl">

        <div class="mb-8">
            <h1 class="mb-4 text-lg font-bold">アカウント新規登録</h1>
            <div class="text-gray-600">
                入力したメールアドレスへ、認証用のメールを送信します。<br>
                お使いのメール設定によって、迷惑メールに入る場合がございます。
            </div>
        </div>

        <div class="rounded border border-gray-300 bg-white p-10">
            <form action="{{ route('postuser.verifymailsignup', $uuid) }}" method="POST">
                @csrf

                <!-- Email Address -->
                <div>
                    <div class="flex flex-row items-end gap-2">
                        <x-input-label for="email" :value="__('Email')" /><span class="text-red-500">*</span>
                    </div>
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    @if (session('error'))
                        <p class="mt-2 font-medium text-red-500">{{ session('error') }}</p>
                    @endif
                </div>

                <div class="mt-6 flex items-center justify-center gap-6">
                    {{-- back to top --}}
                    <a href="{{ route('postuser.index', $uuid) }}" class='min-w-48 flex items-center justify-center rounded-md bg-white px-4 py-2.5 text-sm font-bold text-gray-800 transition-all hover:bg-gray-100'>トップへ戻る
                    </a>

                    {{-- send mail --}}
                    <button type='submit' class='min-w-48 flex items-center justify-center rounded-md bg-gray-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'>メールアドレスを送信
                    </button>
                </div>
            </form>


        </div>
    </div>

@endsection
