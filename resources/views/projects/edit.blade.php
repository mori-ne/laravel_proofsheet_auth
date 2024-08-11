@extends('layouts.master')
@section('title', 'プロジェクトの編集')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">

        <div class="mx-auto max-w-5xl p-6">
            <div class="mb-8">
                <h4 class="text-lg font-bold">プロジェクトの編集</h4>
                {{-- <p class="text-gray-500 text-sm"></p> --}}
            </div>

            {{-- back --}}
            <div class="mb-4 border-gray-300">
                <div class="flex items-center gap-1">
                    <i class="at-arrow-left-circle"></i>
                    <a href="javascript:history.back()">戻る</a>
                </div>
            </div>

            {{-- flash message --}}
            @if (session('status'))
                <div class="[&>svg]:text-foreground relative mb-4 w-full rounded-lg border border-transparent bg-green-50 p-4 text-green-600 [&:has(svg)]:pl-11 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4">
                    <svg class="h-5 w-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h5 class="mb-1 font-medium leading-none tracking-tight">{{ session('status') }}</h5>
                </div>
            @endif

            {{-- content --}}
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- 公開設定・公開期限 --}}
                <div class="mb-8">
                    <h4 class="text-md mb-2 font-bold text-gray-500">公開情報</h4>
                    <div class="rounded-md border border-gray-300 bg-white p-8">
                        <div class="flex flex-row items-center gap-2">
                            {{-- 公開設定 --}}
                            <div class="mr-4">
                                <label class="text-md font-bold">公開設定</label>
                                <select name="status" class="ml-4 rounded-md border-gray-300">
                                    @if ($project->status)
                                        <option value="1" selected>公開中</option>
                                        <option value="0">非公開</option>
                                    @else
                                        <option value="1">公開中</option>
                                        <option value="0" selected>非公開</option>
                                    @endif
                                </select>
                            </div>

                            {{-- 公開期限 --}}
                            <div class="mr-4">
                                <label class="text-md font-bold">公開期限</label>
                                <input name="is_deadline" class="ml-4 rounded-md border-gray-300" type="datetime-local" value="{{ old('is_deadline', $project->is_deadline) }}">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- プロジェクト名・プロジェクトの説明 --}}
                <div class="mb-8">
                    <h4 class="text-md mb-2 font-bold text-gray-500">プロジェクト概要</h4>
                    <div class="rounded-md border border-gray-300 bg-white p-8">
                        {{-- プロジェクト名 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">
                                    プロジェクト名
                                </label>
                                <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                    <span>必須</span>
                                </span>
                            </div>
                            <input name="project_name" type="text" placeholder="プロジェクト名を記入してください" value="{{ old('project_name', $project->project_name) }}"
                                class="text-md ring-offset-background flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 placeholder:text-neutral-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
                            @error('project_name')
                                <div class="mt-2 text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- プロジェクトの説明 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">プロジェクトの説明</label>
                            </div>
                            <textarea id="projectinstance" name="project_description" type="text" placeholder="プロジェクトの説明を記入してください"
                                class="flex h-48 min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('project_description', $project->project_description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- プロジェクトの期間情報・プロジェクトの内容情報 --}}
                <div class="mb-8">
                    <h4 class="text-md mb-2 font-bold text-gray-500">プロジェクト情報</h4>
                    <div class="rounded-md border border-gray-300 bg-white p-8">

                        {{-- 内容情報 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">内容情報</label>
                            </div>
                            <textarea id="projectinstance" name="project_message" type="text" placeholder="プロジェクトの説明を記入してください"
                                class="flex h-48 min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('project_message', $project->project_message) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 返信メールの件名・本文 --}}
                <h4 class="text-md mb-2 font-bold text-gray-500">返信メール情報</h4>
                <div class="rounded-md border border-gray-300 bg-white p-8">
                    <div>
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">返信メールの件名</label>
                            </div>
                            <input name="mail_subject" type="text" placeholder="メールの件名を記入してください" value="{{ old('mail_subject', $project->mail_subject) }}"
                                class="text-md ring-offset-background flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 placeholder:text-neutral-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
                        </div>
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">返信メールの本文</label>
                            </div>
                            <textarea id="projectinstance" name="mail_content" type="text" placeholder="メールの返信内容を記入してください"
                                class="flex h-48 min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{!! old('mail_content', $project->mail_content) !!}</textarea>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border border-gray-300 bg-white p-8">
                    <button type="submit"
                        class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded-md bg-neutral-950 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">更新する</button>
                </div>
            </form>

            <div>
                <span class="pr-4 text-xs text-gray-400">
                    プロジェクト作成日：
                    @if (!$project->created_at)
                        <span class="text-gray-700">無し</span>
                    @else
                        <span class="text-gray-700">
                            {{ $project->created_at }}
                        </span>
                    @endif
                </span>
                <span class="pr-4 text-xs text-gray-400">
                    プロジェクト更新日：
                    @if (!$project->updated_at)
                        <span class="text-gray-700">無し</span>
                    @else
                        <span class="text-gray-700">
                            {{ $project->updated_at }}
                        </span>
                    @endif
                </span>
            </div>

        </div>
    </main>
@endsection
