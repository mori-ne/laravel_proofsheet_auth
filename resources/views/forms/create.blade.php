@extends('layouts.master')
@section('title', 'フォームを新規作成')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>


        <div class="mx-auto max-w-5xl p-6">

            <div class="mb-8">
                <h4 class="text-lg font-bold">フォームを新規作成</h4>
                <p class="text-sm text-gray-500"></p>
            </div>

            {{-- breadcrumb --}}
            <div class="mx-auto mb-4 border-gray-300">
                <div class="flex items-center gap-1">
                    <i class="at-arrow-left-circle"></i>
                    <a href="javascript:history.back()">戻る</a>
                </div>
            </div>

            {{-- content --}}
            <div class="mx-auto mb-3 rounded-md border border-gray-300 bg-white p-8">

                <form action="{{ route('forms.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold">
                                プロジェクトを選択
                            </label>
                            <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                <span>必須</span>
                            </span>
                            <p class="text-xs text-gray-500">作成するプロジェクトを選択してください</p>
                        </div>

                        <select name="project_id" id="selectProject" class="text-md block w-full rounded-md border-gray-300 px-4 py-2 pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @if (request()->input('project') == $project->id) selected @endif>
                                    {{ $project->project_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold">
                                フォーム名
                            </label>
                            <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                <span>必須</span>
                            </span>
                        </div>
                        <input name="form_name" type="text" placeholder="フォーム名を記入してください"
                            class="text-md ring-offset-background flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 placeholder:text-neutral-500 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            value="{{ old('form_name') }}" />
                    </div>

                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold">フォームの説明</label>
                        </div>
                        <textarea name="form_description" type="text" placeholder="フォームの説明を記入してください"
                            class="text-md flex h-48 min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-3 py-2 placeholder:text-neutral-400 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('form_description') }}</textarea>
                    </div>

                    <hr class="my-8">

                    <div class="mt-8">
                        <button type="submit"
                            class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded-md bg-neutral-950 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">新規作成する</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
@endsection
