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
                        <label class='block text-sm font-medium text-gray-700'>お名前（姓）<span class="pl-1 text-red-500">*</span></label>
                        <input name="name_first" type="text" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('name_first') }}">
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label class='block text-sm font-medium text-gray-700'>お名前（名）<span class="pl-1 text-red-500">*</span></label>
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
                    <postal-code-lookup></postal-code-lookup>
                </div>

            </div>

            <hr class="mb-8">

            {{-- password --}}
            <div class="mb-3">
                <label class='mb-2 block text-sm font-medium text-gray-700'>パスワード<span class="pl-1 text-red-500">*</span></label>
                <input name="password" type="password" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('password') }}">
            </div>

            {{-- retype password --}}
            <div class="mb-8">
                <label class='mb-2 block text-sm font-medium text-gray-700'>パスワード（再入力）<span class="pl-1 text-red-500">*</span></label>
                <input name="retypepassword" type="password" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('retypepassword') }}">
            </div>
        </div>

        <div class="mt-6 flex items-center justify-center gap-6">
            <button type="button" class="min-w-48 flex items-center justify-center rounded-md bg-gray-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">新規登録する</button>
        </div>

        {{-- </form> --}}


    </div>
    </div>

@endsection
