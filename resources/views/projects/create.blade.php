@extends('layouts.master')
@section('title', 'プロジェクトを新規作成')
@section('content')

    {{-- top --}}
    @include('layouts.topbar')

    <div class="flex flex-row flex-nowrap">

        {{-- sidebar --}}
        @include('layouts.sidebar')

        <div class="mx-auto h-[calc(100svh_-_56px)] w-full overflow-y-scroll p-6">

            {{-- content --}}
            <div class="w-full rounded border border-neutral-200 bg-white">

                {{-- title --}}
                <div class="border-b border-neutral-200 px-4 py-4">
                    <p class="text-sm font-bold text-neutral-500">プロジェクトを新規作成</p>
                </div>

                {{-- content --}}
                <div class="px-4 pt-6">
                    <form action="{{ route('projects.confirm') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold" for="#">
                                    プロジェクト名
                                </label>
                                <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                    <span>必須</span>
                                </span>
                            </div>
                            <input name="project_name" type="text" placeholder="プロジェクト名を記入してください" value="{{ old('project_name') }}" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" />
                            @error('project_name')
                                <div class="mt-2 text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold" for="#">プロジェクトの概要</label>
                            </div>
                            {{-- projectinstance --}}
                            <textarea id="" name="project_description" type="text" placeholder="プロジェクトの概要を記入してください" class="flex h-48 min-h-[80px] w-full rounded border-0 bg-neutral-100 px-3 py-2 text-sm placeholder:text-neutral-400">{{ old('project_description') }}</textarea>
                            @error('project_description')
                                <div class="mt-2 text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-8">

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold" for="#">公開期限</label>
                                <input name="is_deadline" class="ml-4 rounded border-neutral-200" type="datetime-local" value="{{ old('is_deadline') }}">
                            </div>
                        </div>

                        <hr class="my-8">

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold" for="#">プロジェクトの説明</label>
                            </div>
                            {{-- projectinstance --}}
                            <textarea id="" name="project_message" type="text" placeholder="プロジェクトの説明を記入してください" class="flex h-48 min-h-[80px] w-full rounded border-0 bg-neutral-100 px-3 py-2 text-sm placeholder:text-neutral-400">{{ old('project_message') }}</textarea>
                            @error('project_message')
                                <div class="mt-2 text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-8">

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold" for="#">返信メールの件名</label>
                            </div>
                            <input name="mail_subject" type="text" placeholder="メールの件名を記入してください" value="{{ old('mail_subject', '「●●●●●●●●●●●●●●●●●●●●」演題登録 投稿受付通知') }}" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" />
                        </div>


                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold" for="#">返信メールの本文</label>
                            </div>
                            {{-- projectinstance --}}
                            <textarea id="" name="mail_content" type="text" placeholder="メールの返信内容を記入してください" class="flex h-48 min-h-[80px] w-full rounded border-0 bg-neutral-100 px-3 py-2 text-sm placeholder:text-neutral-400">{!! old(
                                'mail_content',
                                '<p>■演題登録期間<br>～●●●●年●●月●●日（●●）<br><br>※締め切り直前はホームページへのアクセスが集中しますので、 演題登録に時間がかかることが予想されます。時間に余裕をもってご登録をお願いします。<br>※登録された演題のご修正につきましても上記期間内に行うようお願い致します。<br>（演題募集締切後の、演題の登録・確認・修正・削除の操作は一切できません。）予めご了承ください。<br><br>■字数制限<br>文字数︓●●●●文字</p>',
                            ) !!}</textarea>
                        </div>

                        <div class="my-8">
                            <button type="submit"
                                class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">新規作成する</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
