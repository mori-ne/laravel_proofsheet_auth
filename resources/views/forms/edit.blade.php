@extends('layouts.master')
@section('title', 'フォームを編集')
@section('content')

    {{-- top --}}
    <div class="flex flex-row flex-nowrap bg-neutral-600 text-white">
        <!-- Logo -->
        <div class="flex w-48 shrink-0 items-center justify-center border-r border-neutral-500 px-8 text-xl font-extrabold">
            <a href="{{ route('dashboard') }}" class="block w-full">
                <p class="block w-auto fill-current">Proofsheet</p>
            </a>
        </div>

        {{-- info --}}
        <div class="flex h-14 w-full items-center gap-4 px-6">
            <h4 class="text-md shrink-0 font-bold text-white">フォームを編集</h4>
        </div>
    </div>

    <div class="flex flex-row flex-nowrap">
        {{-- sidebar --}}
        @include('layouts.sidebar')
        <div class="mx-auto h-[calc(100svh_-_56px)] w-full overflow-y-scroll p-6">

            {{-- content --}}
            <form action="{{ route('forms.update', $form->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mb-3 rounded border-0 bg-white p-8 shadow-md shadow-neutral-200">

                    {{-- select project --}}
                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold" for="#">プロジェクトを選択</label>
                            <span class="relative rounded-full bg-red-600 py-0.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                <span>必須</span>
                            </span>
                        </div>
                        <select name="project_id" id="project_id" class="rounded border border-neutral-200">
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
                        <input name="form_name" type="text" placeholder="フォーム名を記入してください" value="{{ old('form_name', $form->form_name) }}" class="text-md ring-offset-background flex h-10 w-full rounded border border-neutral-200 bg-white px-3 py-2 placeholder:text-neutral-500" />
                        @error('form_name')
                            <div class="mt-2 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- フォームの説明 --}}
                    <div class="mb-6">
                        <div class="mb-2">
                            <label class="text-lg font-bold" for="form_description">フォームの説明</label>
                        </div>
                        <textarea id="projectinstance" name="form_description" type="text" placeholder="フォームの説明を記入してください" class="flex h-48 min-h-[80px] w-full rounded border border-neutral-200 bg-white px-3 py-2 text-sm placeholder:text-neutral-400">{{ old('form_description', $form->form_description) }}</textarea>
                    </div>
                </div>


                {{-- submit --}}
                <div class="mb-3 rounded border-0 bg-white p-8 shadow-md shadow-neutral-200">
                    <button type="submit"
                        class="focus:shadow-outline mx-auto flex w-96 items-center justify-center rounded bg-neutral-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">フォームを更新する</button>
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
                            {{ \Carbon\Carbon::parse($form->created_at)->format('Y年m月d日') }}
                            {{-- {{ $form->created_at }} --}}
                        </span>
                    @endif
                </span>
                <span class="pr-4 text-xs text-neutral-400">
                    フォーム更新日：
                    @if (!$form->updated_at)
                        <span class="text-neutral-700">無し</span>
                    @else
                        <span class="text-neutral-700">
                            {{ \Carbon\Carbon::parse($form->updated_at)->format('Y年m月d日') }}
                            {{-- {{ $form->updated_at }} --}}
                        </span>
                    @endif
                </span>
            </div>

        </div>
    </div>
@endsection
