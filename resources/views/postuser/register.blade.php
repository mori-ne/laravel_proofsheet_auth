@extends('postuser.layouts.master')
@section('title', 'アカウント本登録 | ' . $project->project_name)
@section('content')


    <div class="mx-auto max-w-xl">

        <div class="mb-8">
            <h1 class="mb-4 text-lg font-bold">アカウント本登録</h1>
        </div>

        <div class="rounded border border-gray-300 bg-white p-10">
            <form action="{{ route('postuser.register', $uuid) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mb-12 flex flex-col gap-12">

                    <!-- Email Address -->
                    <div>
                        <label class='mb-1.5 block text-sm font-bold text-gray-700'>メールアドレス</label>
                        <input name="email" type="email" class='w-full rounded border-0 border-gray-300 bg-gray-100 py-1.5 text-gray-500' value="{{ $email }}" readonly>
                    </div>

                    {{-- name --}}
                    <div>
                        <h6 class="mb-3 font-bold">氏名情報</h6>
                        <div class="flex flex-row gap-2">
                            <div>
                                <label class='mb-1.5 block text-sm font-bold text-gray-700'>お名前（姓）<span class="pl-1 text-red-500">*</span></label>
                                <input name="name_first" type="text" class='w-full rounded border-gray-300 py-1.5 text-gray-700' value="{{ old('name_first') }}">
                                @if ($errors->has('name_first'))
                                    <span id="name_first_error" class="text-sm text-red-500">
                                        {{ $errors->first('name_first') }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <label class='mb-1.5 block text-sm font-bold text-gray-700'>お名前（名）<span class="pl-1 text-red-500">*</span></label>
                                <input name="name_last" type="text" class='w-full rounded border-gray-300 py-1.5 text-gray-700' value="{{ old('name_last') }}">
                                @if ($errors->has('name_last'))
                                    <span id="name_last_error" class="text-sm text-red-500">
                                        {{ $errors->first('name_last') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- 所属 --}}
                    <div>
                        <div class="mb-2">
                            <h6 class="mb-3 font-bold">所属情報</h6>
                            <label class='mb-1.5 block text-sm font-bold text-gray-700'>所属施設名<span class="pl-1 text-red-500">*</span></label>
                            <input name="affiliate" type="text" class='w-full rounded border-gray-300 py-1.5 text-gray-700' value="{{ old('affiliate') }}">
                        </div>
                        <div class="mb-2">
                            <postal-code-lookup></postal-code-lookup>
                        </div>
                    </div>


                </div>


                {{-- password --}}
                <div class="mb-3">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>パスワード<span class="pl-1 text-red-500">*</span></label>
                    <input name="password" type="password" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <span id="password_error" class="text-sm text-red-500">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                {{-- retype password --}}
                <div class="mb-8">
                    <label class='mb-2 block text-sm font-medium text-gray-700'>パスワード（再入力）<span class="pl-1 text-red-500">*</span></label>
                    <input name="retypepassword" type="password" class='w-full rounded border-gray-300 text-gray-700' value="{{ old('retypepassword') }}">
                    @if ($errors->has('retypepassword'))
                        <span id="retypepassword_error" class="text-sm text-red-500">
                            {{ $errors->first('retypepassword') }}
                        </span>
                    @endif
                </div>

                <div class="mt-6 flex items-center justify-center gap-6">
                    <button type="submit" class="min-w-48 flex items-center justify-center rounded-md bg-gray-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">新規登録する</button>
                </div>

            </form>

        </div>
    </div>
@endsection
