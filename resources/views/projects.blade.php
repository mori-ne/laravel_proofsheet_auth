@extends('layouts.master')
@section('title', 'プロジェクト管理')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <div class="mx-auto max-w-5xl p-6">

            {{-- title --}}
            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">プロジェクト管理</h4>
                {{-- <p class="text-neutral-500 text-sm">プロジェクトの一覧がここに表示されます</p> --}}
            </div>



            {{-- search / new project --}}
            <div class="my-3 flex justify-between">

                {{-- search --}}
                <div>
                    <form action="{{ route('projects.search') }}" method="GET" class="flex gap-2">
                        {{-- input --}}
                        <input name="search" type="text" placeholder="プロジェクトを検索" value="{{ request('search') }}" class="flex h-10 w-80 rounded-sm border-0 bg-neutral-100 px-3 py-2 text-sm transition-all placeholder:text-neutral-400 hover:bg-neutral-200 focus:ring-neutral-400" />

                        {{-- sort --}}
                        <select name="sort"
                            class="focus:shadow-outline inline-flex w-48 items-center justify-center rounded-sm border-0 bg-white px-4 py-2 text-sm font-medium text-neutral-500 shadow-sm transition-colors duration-200 hover:bg-neutral-100 hover:text-neutral-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white">
                            <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>
                                更新日（新しい順）
                            </option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>
                                更新日（古い順）
                            </option>
                            <option value="iddesc" {{ request('sort') == 'iddesc' ? 'selected' : '' }}>
                                ID（大きい順）
                            </option>
                            <option value="idasc" {{ request('sort') == 'idasc' ? 'selected' : '' }}>
                                ID（小さい順）
                            </option>
                        </select>

                        {{-- submit --}}
                        <button type="submit"
                            class="focus:shadow-outline inline-flex items-center justify-center rounded-sm border-0 bg-white px-4 py-2 text-sm font-medium tracking-wide text-neutral-500 shadow-sm transition-colors duration-200 hover:bg-neutral-100 hover:text-neutral-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white">
                            検索
                        </button>
                    </form>
                </div>

                {{-- new project --}}
                <div>
                    <a href="{{ route('projects.create') }}" type="button"
                        class="focus:shadow-outline inline-flex items-center justify-center rounded-sm bg-neutral-700 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                        プロジェクトを新規作成
                    </a>
                </div>
            </div>

            {{-- if --}}
            @if ($projects->isEmpty())
                <div class="w-full rounded-lg border-2 border-dashed border-neutral-300 px-32 py-16 text-center text-sm text-neutral-600">
                    プロジェクトは見つかりませんでした...
                </div>
            @endif

            {{-- lists --}}
            @foreach ($projects as $key => $project)
                <div class="mb-3 rounded-sm border-0 border-neutral-300 bg-white shadow-md shadow-neutral-200">

                    {{-- publish / project name / dropdown menu / published_at / form count / created_at --}}



                    <div class="border-0 border-neutral-300 px-6 pb-6 pt-6">
                        <div class="flex flex-row items-center justify-between gap-2">
                            {{-- project name --}}
                            <h5 class="mb-1 text-xl font-bold leading-none tracking-tight text-neutral-700">
                                <a href="{{ route('projects.show', $project->id) }}" class="hover:underline">{{ $project->project_name }}</a>
                            </h5>

                            {{-- form toggle --}}
                            <div class="ml-auto flex flex-row gap-1 text-sm">
                                <button id="toggleButton{{ $key }}" class="flex flex-row items-center gap-2 rounded px-3 py-1 text-sm hover:bg-neutral-100" type="button">フォームを開く<i class="at-arrow-down-circle"></i></button>
                            </div>

                            {{-- dropdown menu --}}
                            <div x-data="{
                                dropdownOpen: false
                            }" class="relative">

                                <button @click="dropdownOpen=true"
                                    class="inline-flex h-6 items-center justify-center rounded-sm bg-white px-2 text-sm font-medium transition-colors hover:bg-neutral-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50"><i
                                        class="at-dots-vertical"></i></button>

                                <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" class="z-100 absolute left-1/2 top-0 mt-10 w-44 -translate-x-1/2" x-cloak>
                                    <div class="rounded-sm border border-neutral-300 bg-white p-1 text-sm text-neutral-700 shadow-md">
                                        <a href="{{ route('projects.show', ['id' => $project->id]) }}" @click="menuBarOpen=false"
                                            class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            <span>プロジェクトの詳細</span>
                                        </a>
                                        <a href="{{ route('projects.edit', $project->id) }} @click=" menuBarOpen=false"
                                            class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            <span>プロジェクトを編集</span>
                                        </a>
                                        <form action="{{ route('projects.duplicate', $project->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" @click="menuBarOpen=false"
                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                                <span>プロジェクトを複製</span>
                                            </button>
                                        </form>
                                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                            <button @click="modalOpen=true"
                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 text-red-500 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">プロジェクトを削除</button>
                                            <template x-teleport="body">
                                                <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0" @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-neutral-800 bg-opacity-40">
                                                    </div>
                                                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">プロジェクトを削除
                                                            </h3>
                                                            <button @click="modalOpen=false" class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-neutral-600 hover:bg-neutral-50 hover:text-neutral-800">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="relative mb-4 w-auto">
                                                            <p>本当に削除してもよろしいですか？</p>
                                                            <p class="text-sm text-red-500">※この操作は取り消せません
                                                            </p>
                                                        </div>
                                                        <div class="flex">
                                                            <form class="ml-auto" action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="focus:shadow-outline inline-flex items-center justify-center rounded-sm bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
                                                                    削除
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- published_at / form count / created_at --}}
                        <div class="flex items-center gap-4">
                            {{-- url --}}
                            <div class="flex items-center">
                                {{-- <p class="text-sm text-neutral-500">公開URL：</p> --}}
                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('postuser.index', ['uuid' => $project->uuid]) }}" target="_blank">{{ route('postuser.index', ['uuid' => $project->uuid]) }}</a>
                            </div>

                        </div>
                    </div>


                    <div id="forms{{ $key }}" class="hidden border-0 border-neutral-300 px-6 pb-2">
                        @foreach ($project->forms as $key => $form)
                            <div class="flex flex-row items-center rounded-sm px-4 py-3 hover:bg-neutral-100">
                                <p class="text-md pr-3 text-neutral-400">
                                    {{ $key + 1 }}
                                </p>
                                <a href="{{ route('forms.show', $form->id) }}" class="hover:underline">
                                    {{ $form->form_name }}
                                </a>
                                {{-- {{ $form->form_description }} --}}
                                <div class="ml-auto flex flex-row gap-1">
                                    {{-- dropdown menu --}}
                                    <a href="{{ route('forms.inputEdit', $form->id) }}" target="_blank" class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200">入力項目エディターを開く</a>
                                    <a class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200" href="{{ route('forms.show', $form->id) }}" @click="menuBarOpen=false"
                                        class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                        <span>詳細</span>
                                    </a>
                                    <a class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200" href="{{ route('forms.edit', $form->id) }}" @click="menuBarOpen=false"
                                        class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                        <span>編集</span>
                                    </a>
                                    <form action="{{ route('forms.duplicate', $form->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" @click="menuBarOpen=false" class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200">
                                            <span>複製</span>
                                        </button>
                                    </form>
                                    <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                        <button @click="modalOpen=true" class="flex items-center justify-center rounded px-2 py-1 text-sm text-red-500 hover:bg-red-100 hover:text-red-500">削除</button>
                                        <template x-teleport="body">
                                            <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0" @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-neutral-800 bg-opacity-40">
                                                </div>
                                                <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

                                                    <div class="flex items-center justify-between pb-2">
                                                        <h3 class="text-lg font-semibold">フォームを削除</h3>
                                                        <button @click="modalOpen=false" class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-neutral-600 hover:bg-neutral-50 hover:text-neutral-800">
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="relative mb-4 w-auto">
                                                        <p>本当に削除してもよろしいですか？</p>
                                                        <p class="text-sm text-red-500">
                                                            ※この操作は取り消せません
                                                        </p>
                                                    </div>
                                                    <div class="flex">
                                                        <form class="ml-auto" action="{{ route('forms.destroy', $form->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="focus:shadow-outline inline-flex items-center justify-center rounded-sm bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
                                                                フォームを削除
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- publish --}}
                    <div class="flex items-center justify-start gap-2 border-0 border-neutral-300 px-6 pb-4 pt-2">
                        @if ($project->status)
                            {{-- 公開中 --}}
                            <form name="toggleStatus" action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="relative flex items-center rounded-full bg-green-600 py-1.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                    <svg class="relative h-5 w-5 -translate-x-0.5 opacity-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>公開中</span>
                                </button>
                            </form>
                        @else
                            {{-- 非公開 --}}
                            <form name="toggleStatus" action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="relative flex items-center rounded-full bg-neutral-300 py-1.5 pl-2 pr-2.5 text-xs font-semibold text-white">
                                    <svg class="relative h-5 w-5 -translate-x-0.5 opacity-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>
                                        非公開
                                    </span>
                                </button>
                            </form>
                        @endif

                        {{-- form count --}}
                        <div class="flex items-center gap-1 rounded-full bg-orange-400 py-2 pl-2 pr-0.5 text-white">
                            <p class="flex h-4 w-4 items-center justify-center rounded-full bg-white text-xs font-bold text-orange-400">
                                {{ $project->forms->count() }}
                            </p>
                            <p class="pr-2 text-xs text-white">フォーム数</p>
                        </div>

                        <div class="ml-4 flex flex-col">
                            {{-- published_at --}}
                            <div class="flex items-center">
                                <p class="pr-2 text-sm text-neutral-500">公開期限</p>
                                <p class="text-sm font-bold text-neutral-900">
                                    @if ($project->is_deadline)
                                        {{ \Carbon\Carbon::parse($project->is_deadline)->format('Y年m月d日 H時i分') }}
                                        {{-- {{ $project->is_deadline }} --}}
                                    @else
                                        設定なし
                                    @endif
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                {{-- created_at --}}
                                <div class="flex items-center">
                                    <p class="text-xs text-neutral-400">作成日：</p>
                                    <p class="text-xs text-neutral-400">
                                        {{ \Carbon\Carbon::parse($project->created_at)->format('Y年m月d日') }}
                                        {{-- {{ $project->created_at }} --}}
                                    </p>
                                </div>
                                {{-- updated_at --}}
                                <div class="flex items-center">
                                    <p class="text-xs text-neutral-400">更新日：</p>
                                    <p class="text-xs text-neutral-400">
                                        {{ \Carbon\Carbon::parse($project->updated_at)->format('Y年m月d日') }}
                                        {{-- {{ $project->updated_at }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- id --}}
                        <div class="ml-auto flex items-center">
                            <p class="text-md ml-auto w-fit pr-1 font-bold text-neutral-400">
                                {{ $project->id }}
                            </p>
                        </div>


                    </div>



                </div>
            @endforeach

            {{ $projects->links() }}


        </div>
    </main>

    <script>
        @foreach ($projects as $key => $project)
            document.getElementById('toggleButton{{ $key }}').addEventListener('click', function() {
                const forms = document.getElementById('forms{{ $key }}');

                if (forms.style.display === 'block') {
                    forms.style.display = 'none';
                } else {
                    forms.style.display = 'block';
                }
            });
        @endforeach
    </script>
@endsection
