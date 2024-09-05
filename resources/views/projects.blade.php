@extends('layouts.master')
@section('title', 'プロジェクト管理')
@section('content')

    {{-- top --}}
    <div class="flex flex-row flex-nowrap bg-neutral-600 text-white">
        <!-- Logo -->
        <div class="flex w-48 shrink-0 items-center justify-center border-r border-neutral-500 pl-4 text-xl font-extrabold">
            <a href="{{ route('dashboard') }}" class="block w-full">
                <p class="block w-auto fill-current">Proofsheet</p>
            </a>
        </div>

        {{-- info --}}
        <div class="flex h-14 w-full items-center gap-4 px-6">
            <h4 class="text-md shrink-0 font-bold text-white">プロジェクト管理</h4>
            {{-- search --}}
            <div class="flex w-full items-center justify-end gap-2">
                {{-- search --}}
                <div>
                    <form action="{{ route('projects.search') }}" method="GET" class="flex gap-2">
                        {{-- input --}}
                        <input name="search" type="text" placeholder="プロジェクトを検索…" value="{{ request('search') }}" class="flex h-9 w-80 rounded border-0 bg-neutral-400 px-3 py-2 text-sm text-neutral-700 transition-all placeholder:text-neutral-600 hover:bg-neutral-300 focus:bg-neutral-300" />

                        {{-- sort --}}
                        <select name="sort" class="flex h-9 w-48 items-center justify-center rounded border-0 bg-white px-4 py-0 text-sm font-medium text-neutral-500 shadow-sm transition-colors duration-200">
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
                            class="ml-auto flex h-9 items-center justify-center rounded border-0 bg-white px-4 py-2 text-sm font-medium tracking-wide text-neutral-500 shadow-sm transition-colors duration-200 hover:bg-neutral-100 hover:text-neutral-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white">
                            検索
                        </button>
                    </form>
                </div>

                {{-- new project --}}
                <div>
                    <a href="{{ route('projects.create') }}" type="button"
                        class="focus:shadow-outline inline-flex items-center justify-center rounded bg-neutral-800 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                        プロジェクトを新規作成
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-nowrap">

        {{-- sidebar --}}
        @include('layouts.sidebar')

        <div class="mx-auto h-[calc(100svh_-_56px)] w-full overflow-y-scroll p-6">

            {{-- lists --}}
            <div class="w-full rounded border border-neutral-200 bg-white">

                {{-- title --}}
                <div class="border-b border-neutral-200 px-4 py-4">
                    <p class="text-sm font-bold text-neutral-500">プロジェクト一覧</p>
                </div>

                {{-- tab --}}
                <div class="px-4 pt-6">
                    <ul class="flex flex-row gap-2">
                        <form action="{{ route('projects.search') }}" method="GET">
                            <li>
                                <input type="hidden" name="publish" value="all">
                                @if (request()->input('publish') == 'all')
                                    <button type="submit" class="rounded-full border border-orange-600 bg-orange-600 px-3 py-1 text-xs font-bold text-white transition-all">すべて</button>
                                @else
                                    <button type="submit" class="rounded-full border border-neutral-200 bg-white px-3 py-1 text-xs font-bold text-neutral-600 transition-all hover:border-orange-600 hover:bg-orange-600 hover:text-white">すべて</button>
                                @endif
                            </li>
                        </form>
                        <form action="{{ route('projects.search') }}" method="GET">
                            <li>
                                <input type="hidden" name="publish" value="public">
                                @if (request()->input('publish') == 'public')
                                    <button type="submit" class="rounded-full border border-green-600 bg-green-600 px-3 py-1 text-xs font-bold text-white transition-all">公開中</button>
                                @else
                                    <button type="submit" class="rounded-full border border-neutral-200 bg-white px-3 py-1 text-xs font-bold text-neutral-600 transition-all hover:border-green-600 hover:bg-green-600 hover:text-white">公開中</button>
                                @endif
                            </li>
                        </form>
                        <form action="{{ route('projects.search') }}" method="GET">
                            <li>
                                <input type="hidden" name="publish" value="private">
                                @if (request()->input('publish') == 'private')
                                    <button type="submit" class="rounded-full border border-neutral-600 bg-neutral-600 px-3 py-1 text-xs font-bold text-white transition-all">非公開</button>
                                @else
                                    <button type="submit" class="rounded-full border border-neutral-200 bg-white px-3 py-1 text-xs font-bold text-neutral-600 transition-all hover:border-neutral-600 hover:bg-neutral-600 hover:text-white">非公開</button>
                                @endif
                            </li>
                        </form>
                    </ul>
                </div>

                {{-- table --}}
                <div class="px-6 py-6 pb-4">
                    <table width="100%">
                        {{-- table haeder --}}
                        <thead>
                            <tr>
                                <th class="border-b border-neutral-200 py-2 pr-1 text-left text-xs font-bold text-neutral-600">No.</th>
                                <th class="w-2/3 border-b border-neutral-200 py-2 pr-4 text-left text-xs font-bold text-neutral-600">プロジェクト名</th>
                                <th class="border-b border-neutral-200 py-2 pr-4 text-left text-xs font-bold text-neutral-600">ステータス</th>
                                <th class="border-b border-neutral-200 py-2 pr-4 text-left text-xs font-bold text-neutral-600">公開期限</th>
                            </tr>
                        </thead>

                        {{-- if --}}
                        @if ($projects->isEmpty())
                            <tr>
                                <td class="w-full" colspan="4">
                                    <p class="my-8 flex h-32 items-center justify-center rounded border border-dashed border-neutral-300 text-center text-sm text-neutral-600">
                                        プロジェクトは見つかりませんでした...
                                    </p>
                                </td>
                            </tr>
                        @endif

                        <tbody>
                            @foreach ($projects as $key => $project)
                                <tr class="border-0 border-t border-neutral-200">
                                    {{-- id --}}
                                    <td class="pb-1 pr-1 pt-3">
                                        <p class="text-md w-fit font-bold text-neutral-400">
                                            {{ $project->id }}
                                        </p>
                                    </td>

                                    {{-- project_name / controller --}}
                                    <td class="pb-1 pr-4 pt-3">
                                        {{-- project name --}}
                                        <h5 class="mb-1 text-lg font-bold leading-none text-neutral-700">
                                            <a href="{{ route('projects.show', $project->id) }}" class="hover:underline">{{ $project->project_name }}</a>
                                        </h5>

                                        {{-- controller --}}
                                        <div class="ml-auto flex flex-row items-center gap-3">
                                            {{-- form toggle --}}
                                            <div class="flex flex-row gap-1 text-sm">
                                                <button id="toggleButton{{ $key }}" class="flex flex-row items-center gap-1 text-sm" type="button">
                                                    <p class="flex h-4 w-4 items-center justify-center rounded-full bg-orange-400 text-xs font-bold text-white">
                                                        {{ $project->forms->count() }}
                                                    </p>
                                                    フォームを開く
                                                </button>
                                            </div>

                                            {{-- url --}}
                                            {{-- <p class="text-sm text-neutral-500">公開URL：</p> --}}
                                            <a class="text-sm" href="{{ route('postuser.index', ['uuid' => $project->uuid]) }}" target="_blank">投稿ページを開く</a>

                                            {{-- show --}}
                                            <a href="{{ route('projects.show', ['id' => $project->id]) }}" @click="menuBarOpen=false" class="text-sm">
                                                <span>詳細</span>
                                            </a>

                                            {{-- edit --}}
                                            <a href="{{ route('projects.edit', $project->id) }} @click=" menuBarOpen=false" class="text-sm">
                                                <span>編集</span>
                                            </a>

                                            {{-- duplicate --}}
                                            <form action="{{ route('projects.duplicate', $project->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" @click="menuBarOpen=false" class="text-sm">
                                                    <span>複製</span>
                                                </button>
                                            </form>

                                            {{-- delete --}}
                                            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                                <button @click="modalOpen=true" class="text-sm text-red-500">削除</button>
                                                <template x-teleport="body">
                                                    <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                                            x-transition:leave-end="opacity-0" @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-neutral-800 bg-opacity-40">
                                                        </div>
                                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

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
                                                                        class="focus:shadow-outline inline-flex items-center justify-center rounded bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
                                                                        削除
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- publish --}}
                                    <td class="pb-1 pr-4 pt-3">
                                        <div class="flex items-center justify-start gap-2 border-0 border-neutral-300">
                                            @if ($project->status)
                                                {{-- 公開中 --}}
                                                <form name="toggleStatus" action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST" class="rounded-full px-2 transition-all hover:bg-green-100">
                                                    @csrf
                                                    <button type="submit">
                                                        @csrf
                                                        <div class="flex flex-row flex-nowrap items-center gap-2">
                                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                                            <span class="text-sm text-green-700">公開中</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            @else
                                                {{-- 非公開 --}}
                                                <form name="toggleStatus" action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST" class="rounded-full px-2 transition-all hover:bg-neutral-100">
                                                    <button type="submit">
                                                        @csrf
                                                        <div class="flex flex-row flex-nowrap items-center gap-2">
                                                            <div class="h-2.5 w-2.5 rounded-full bg-neutral-300"></div>
                                                            <span class="text-sm text-neutral-500">非公開</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- published_at --}}
                                    <td class="pb-1 pr-4 pt-3">
                                        <p class="text-sm text-neutral-900">
                                            @if ($project->is_deadline)
                                                {{ \Carbon\Carbon::parse($project->is_deadline)->format('Y年m月d日 H時i分') }}
                                            @else
                                                設定なし
                                            @endif
                                        </p>
                                    </td>
                                </tr>

                                {{-- forms --}}
                                <tr>
                                    <td colspan="4">
                                        <div id="forms{{ $key }}" class="hidden">
                                            <div class="py-1 pb-3">
                                                @foreach ($project->forms as $key => $form)
                                                    <div class="ml-9 mr-20 flex flex-row items-center gap-2">
                                                        <p class="text-md pr-3 text-neutral-400">{{ $key + 1 }}</p>
                                                        <a href="{{ route('forms.show', $form->id) }}" class="hover:underline">{{ $form->form_name }}</a>
                                                        {{-- {{ $form->form_description }} --}}
                                                        <div class="ml-auto flex flex-row gap-1">
                                                            {{-- dropdown menu --}}
                                                            <a href="{{ route('forms.inputEdit', $form->id) }}" target="_blank" class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200">入力項目エディターを開く</a>
                                                            <a class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200" href="{{ route('forms.show', $form->id) }}" @click="menuBarOpen=false"
                                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900">
                                                                <span>詳細</span>
                                                            </a>
                                                            <a class="flex items-center justify-center rounded px-2 py-1 text-sm hover:bg-neutral-200" href="{{ route('forms.edit', $form->id) }}" @click="menuBarOpen=false"
                                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900">
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
                                                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

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
                                                                                        class="focus:shadow-outline inline-flex items-center justify-center rounded bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            {{ $projects->links() }}

        </div>
    </div>


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
