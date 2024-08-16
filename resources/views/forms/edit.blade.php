@extends('layouts.master')
@section('title', 'フォームを編集')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <div class="mx-auto max-w-5xl p-6">

            {{-- title --}}
            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">フォームを編集</h4>
                <p class="text-sm text-neutral-500"></p>
            </div>

            {{-- back --}}
            <div class="mb-4 border-neutral-300">
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
            <form action="{{ route('forms.update', $form->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mb-3 rounded-md border border-neutral-300 bg-white p-8">


                    {{-- select project --}}
                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold" for="#">プロジェクトを選択</label>
                            <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                <span>必須</span>
                            </span>
                        </div>
                        <select name="project_id" id="project_id" class="rounded border border-neutral-300">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @if ($form->project_id === $project->id) selected @endif>
                                    {{ $project->project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- form name --}}
                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold" for="form_name">フォーム名</label>
                            <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                <span>必須</span>
                            </span>
                        </div>
                        <input name="form_name" type="text" placeholder="フォーム名を記入してください" value="{{ old('form_name', $form->form_name) }}"
                            class="text-md ring-offset-background flex h-10 w-full rounded-md border border-neutral-300 bg-white px-3 py-2 placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
                        @error('form_name')
                            <div class="mt-2 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- フォームの説明 --}}
                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold" for="form_description">フォームの説明</label>
                        </div>
                        <textarea id="projectinstance" name="form_description" type="text" placeholder="フォームの説明を記入してください"
                            class="flex h-48 min-h-[80px] w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('form_description', $form->form_description) }}</textarea>
                    </div>
                </div>


                {{-- submit --}}
                <div class="mb-3 rounded-md border border-neutral-300 bg-white p-8">
                    <button type="submit"
                        class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded-md bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">フォームを更新する</button>
                </div>
            </form>

            {{-- created_at / updated_at --}}
            <div>
                <span class="pr-4 text-xs text-neutral-400">
                    フォーム作成日：
                    @if (!$form->created_at)
                        <span class="text-neutral-700">無し</span>
                    @else
                        <span class="text-neutral-700">
                            {{ $form->created_at }}
                        </span>
                    @endif
                </span>
                <span class="pr-4 text-xs text-neutral-400">
                    フォーム更新日：
                    @if (!$form->updated_at)
                        <span class="text-neutral-700">無し</span>
                    @else
                        <span class="text-neutral-700">
                            {{ $form->updated_at }}
                        </span>
                    @endif
                </span>
            </div>

        </div>
    </main>
@endsection
