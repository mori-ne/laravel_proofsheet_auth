@extends('layouts.master')
@section('title', 'プロジェクトの編集')
@section('content')

    @include('layouts.topbar')

    <div class="flex flex-row flex-nowrap">
        {{-- sidebar --}}
        @include('layouts.sidebar')

        <div class="mx-auto max-w-5xl p-6">

            {{-- content --}}
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- プロジェクト名・プロジェクトの説明 --}}
                <div class="mb-8">
                    <h4 class="text-md mb-2 font-bold text-neutral-500">プロジェクト概要</h4>
                    <div class="rounded border-0 bg-white p-6 shadow-md shadow-neutral-200">
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
                            <input name="project_name" type="text" placeholder="プロジェクト名を記入してください" value="{{ old('project_name', $project->project_name) }}" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" />
                            @error('project_name')
                                <div class="mt-2 text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- プロジェクトの説明 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">プロジェクトの説明</label>
                            </div>
                            <textarea id="projectinstance" name="project_description" type="text" placeholder="プロジェクトの説明を記入してください" class="flex h-32 min-h-[80px] w-full rounded bg-white px-3 py-2 text-sm placeholder:text-neutral-400">{{ old('project_description', $project->project_description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 公開設定・公開期限 --}}
                <div class="mb-8">
                    <h4 class="text-md mb-2 font-bold text-neutral-500">公開情報</h4>
                    <div class="rounded bg-white p-6 shadow-md shadow-neutral-200">
                        <div class="flex flex-row items-center gap-2">
                            {{-- 公開設定 --}}
                            <div class="mr-4">
                                <label class="text-md font-bold">公開設定</label>
                                <select name="status" class="roundedd ml-4 rounded border-0 shadow-sm shadow-neutral-300">
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
                                <input name="is_deadline" class="roundedd ml-4 rounded border-0 shadow-sm shadow-neutral-300" type="datetime-local" value="{{ old('is_deadline', $project->is_deadline) }}">
                            </div>

                        </div>
                    </div>
                </div>



                {{-- プロジェクトの期間情報・プロジェクトの内容情報 --}}
                <div class="mb-8">
                    <h4 class="text-md mb-2 font-bold text-neutral-500">プロジェクト情報</h4>
                    <div class="roundedr bg-white p-8">

                        {{-- 内容情報 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">内容情報</label>
                            </div>
                            <textarea id="projectinstance" name="project_message" type="text" placeholder="プロジェクトの説明を記入してください" class="flex h-48 min-h-[80px] w-full rounded bg-white px-3 py-2 text-sm placeholder:text-neutral-400">{{ old('project_message', $project->project_message) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 返信メールの件名・本文 --}}
                <h4 class="text-md mb-2 font-bold text-neutral-500">返信メール情報</h4>
                <div class="roundedr bg-white p-8">
                    <div>
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">返信メールの件名</label>
                            </div>
                            <input name="mail_subject" type="text" placeholder="メールの件名を記入してください" value="{{ old('mail_subject', $project->mail_subject) }}" class="text-md ring-offset-background flex h-10 w-full rounded border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-500" />
                        </div>
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-md font-bold">返信メールの本文</label>
                            </div>
                            <textarea id="projectinstance" name="mail_content" type="text" placeholder="メールの返信内容を記入してください" class="flex h-48 min-h-[80px] w-full rounded bg-white px-3 py-2 text-sm placeholder:text-neutral-400">{!! old('mail_content', $project->mail_content) !!}</textarea>
                        </div>
                    </div>
                </div>

                <div class="roundedr bg-white p-8">
                    <button type="submit"
                        class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">更新する</button>
                </div>
            </form>

            <div>
                <span class="pr-4 text-xs text-neutral-400">
                    プロジェクト作成日：
                    @if (!$project->created_at)
                        <span class="text-neutral-700">無し</span>
                    @else
                        <span class="text-neutral-700">
                            {{ $project->created_at }}
                        </span>
                    @endif
                </span>
                <span class="pr-4 text-xs text-neutral-400">
                    プロジェクト更新日：
                    @if (!$project->updated_at)
                        <span class="text-neutral-700">無し</span>
                    @else
                        <span class="text-neutral-700">
                            {{ $project->updated_at }}
                        </span>
                    @endif
                </span>
            </div>

        </div>

    </div>
@endsection
