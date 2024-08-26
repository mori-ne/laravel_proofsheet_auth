@extends('layouts.master')
@section('title', 'フォームを新規作成')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">

        {{-- title --}}
        <div class="flex h-14 items-center gap-4 bg-neutral-600 px-6">
            <h4 class="text-md shrink-0 font-bold text-white">フォームを新規作成</h4>
        </div>

        <div class="mx-auto max-w-7xl p-6">

            {{-- content --}}
            <div class="mx-auto mb-3 rounded-sm border-0 bg-white p-8 shadow-md shadow-neutral-200">

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
                            <p class="text-xs text-neutral-500">作成するプロジェクトを選択してください</p>
                        </div>

                        <select name="project_id" id="selectProject" class="text-md block w-full rounded-sm border-0 px-4 py-2 shadow-sm shadow-neutral-300">
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
                        <input name="form_name" type="text" placeholder="フォーム名を記入してください" class="text-md ring-offset-background flex h-10 w-full rounded-sm border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-400" value="{{ old('form_name') }}" />
                    </div>

                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold">フォームの説明</label>
                        </div>
                        <textarea name="form_description" type="text" placeholder="フォームの説明を記入してください" class="text-md flex h-48 min-h-[80px] w-full rounded-sm border-0 bg-neutral-100 px-3 py-2 placeholder:text-neutral-400">{{ old('form_description') }}</textarea>
                    </div>

                    <hr class="my-8">

                    <div class="mt-8">
                        <button type="submit"
                            class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded-sm bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">新規作成する</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
@endsection
