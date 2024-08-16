@extends('layouts.master')
@section('title', 'プロジェクト確認画面')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-neutral-800">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>


        <div class="mx-auto max-w-5xl p-6">

            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">プロジェクト確認画面</h4>
                <p class="text-sm text-neutral-500"></p>
            </div>

            {{-- breadcrumb --}}
            <div class="mb-4 border-neutral-300">
                <div class="flex items-center gap-1">
                    <i class="at-arrow-left-circle"></i>
                    <a href="javascript:history.back()">戻る</a>
                </div>
            </div>

            {{-- content --}}
            <div class="mb-3 rounded-md border border-neutral-300 bg-white p-8">

                <div class="mb-6">
                    <div class="mb-2">
                        <label class="text-lg font-bold" for="#">
                            プロジェクト名
                        </label>
                        <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                            <span>必須</span>
                        </span>
                    </div>
                    <div class="rounded border p-3">{{ $project['project_name'] }}</div>
                </div>

                <div class="mb-6">
                    <div class="mb-2">
                        <label class="text-lg font-bold" for="#">プロジェクトの概要</label>
                    </div>
                    <div class="rounded border p-3 text-sm">
                        @if (!$project['project_description'])
                            <span class="text-neutral-400">なし</span>
                        @else
                            {!! $project['project_description'] !!}
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <div class="mb-2">
                        <label class="text-lg font-bold" for="#">公開期限</label>
                    </div>
                    <div class="rounded border p-3">
                        @if (!$project['is_deadline'])
                            <span class="text-neutral-400">指定しない</span>
                        @else
                            {{ $project['is_deadline'] }}
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <div class="mb-2">
                        <label class="text-lg font-bold" for="#">プロジェクトの説明</label>
                    </div>
                    <div class="rounded border p-3">
                        @if (!$project['project_message'])
                            <span class="text-neutral-400">なし</span>
                        @else
                            {!! $project['project_message'] !!}
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <div class="mb-2">
                        <label class="text-lg font-bold" for="#">返信メールの件名</label>
                    </div>
                    <div class="rounded border p-3">
                        @if (!$project['mail_subject'])
                            <span class="text-neutral-400">なし</span>
                        @else
                            {{ $project['mail_subject'] }}
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <div class="mb-2">
                        <label class="text-lg font-bold" for="#">返信メールの本文</label>
                    </div>
                    <div class="rounded border p-3 text-sm">
                        @if (!$project['mail_content'])
                            <span class="text-neutral-400">なし</span>
                        @else
                            {!! $project['mail_content'] !!}
                        @endif
                    </div>
                </div>

                <div class="mt-8">
                    <p class="mb-4 text-center text-sm text-neutral-500">この内容で新規登録します。よろしいですか？</p>

                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_name" value="{{ $project['project_name'] }}">
                        <input type="hidden" name="project_description" value="{{ $project['project_description'] }}">
                        <input type="hidden" name="project_message" value="{{ $project['project_message'] }}">
                        <input type="hidden" name="is_deadline" value="{{ $project['is_deadline'] }}">
                        <input type="hidden" name="mail_subject" value="{{ $project['mail_subject'] }}">
                        <input type="hidden" name="mail_content" value="{{ $project['mail_content'] }}">
                        <button type="submit"
                            class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded-md bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                            新規作成する
                        </button>
                </div>
                </form>
            </div>

        </div>
    </main>
@endsection
