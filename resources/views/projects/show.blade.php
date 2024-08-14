@extends('layouts.master')
@section('title', 'プロジェクトの詳細')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="mx-auto max-w-5xl p-6">

            <div class="mb-8">
                <h4 class="text-lg font-bold">プロジェクトの詳細</h4>
                {{-- <p class="text-gray-500 text-sm">プロジェクトの詳細画面です。確認、編集、削除ができます</p> --}}
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

            {{-- controll --}}
            <div class="mb-4 flex items-center gap-4">
                {{-- 公開／非公開 --}}
                <div>
                    @if ($project->status)
                        {{-- 公開中 --}}
                        <form name="toggleStatus" action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="relative flex h-8 w-20 items-center justify-center rounded-full bg-green-600 py-1 pl-2 pr-2.5 text-sm font-semibold text-white">
                                <svg class="relative h-4 w-4 -translate-x-0.5 opacity-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
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
                            <button type="sumbit" class="relative flex h-8 w-20 items-center justify-center rounded-full bg-gray-300 py-1 pl-2 pr-2.5 text-sm font-semibold text-white">
                                <svg class="relative h-4 w-4 -translate-x-0.5 opacity-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>非公開</span>
                            </button>
                        </form>
                    @endif
                </div>

                {{-- 公開期限 --}}
                <div class="flex items-center gap-2">
                    <p class="text-gray-400">公開期限</p>
                    <p class="text-lg font-bold">
                        @if ($project->is_deadline)
                            {{ $project->is_deadline }}
                        @else
                            設定なし
                        @endif
                    </p>
                </div>
                {{-- dropdown menu project --}}
                <div x-data="{
                    dropdownOpen: false
                }" class="relative ml-auto">

                    <button @click="dropdownOpen=true"
                        class="transition-colorsrounded-md inline-flex items-center justify-center px-4 py-2 text-lg font-medium hover:bg-neutral-100 focus:rounded focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50"><i
                            class="at-dots-vertical"></i></button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" class="absolute left-1/2 top-0 z-50 mt-10 w-44 -translate-x-1/2" x-cloak>
                        <div class="rounded-md border border-gray-300 bg-white p-1 text-sm text-neutral-700 shadow-md">

                            {{-- edit --}}
                            <a href="{{ route('projects.edit', $project->id) }}" @click="menuBarOpen=false"
                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                <span>プロジェクトを編集</span>
                            </a>

                            {{-- delete --}}
                            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                <button @click="modalOpen=true"
                                    class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 text-red-500 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">プロジェクトを削除</button>
                                <template x-teleport="body">
                                    <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-black bg-opacity-40">
                                        </div>
                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

                                            <div class="flex items-center justify-between pb-2">
                                                <h3 class="text-lg font-semibold">プロジェクトを削除</h3>
                                                <button @click="modalOpen=false" class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 hover:bg-gray-50 hover:text-gray-800">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="relative mb-4 w-auto">
                                                <p>本当に削除してもよろしいですか？</p>
                                                <p class="text-sm text-red-500">※この操作は取り消せません</p>
                                            </div>
                                            <div class="flex">
                                                <form class="ml-auto" action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="focus:shadow-outline inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
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

            {{-- project --}}
            <div class="mb-8 border-b border-t border-gray-300 py-6">
                {{-- <h4 class="text-md font-bold mb-2 text-gray-500">プロジェクト情報</h4> --}}
                {{-- project name / project description --}}
                <div class="mb-6">
                    <h5 class="mb-3 text-2xl font-bold leading-none text-neutral-900">
                        {{ $project->project_name }}
                    </h5>
                    <h5 class="mb-2 text-lg leading-none">
                        <div class="text-md">{!! $project->project_description !!}</div>
                    </h5>
                </div>
                {{-- public url --}}
                <div class="">
                    <p class="text-sm text-gray-400">公開URL（URLは変更できません）</p>
                    <a class="text-md text-blue-700 underline" href="{{ route('postuser.index', ['uuid' => $project->uuid]) }}" target="_blank">
                        {{ route('postuser.index', ['uuid' => $project->uuid]) }}
                    </a>
                </div>
            </div>

            <div x-data="{
                tabSelected: 1,
                tabId: $id('tabs'),
                tabButtonClicked(tabButton) {
                    this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
                    this.tabRepositionMarker(tabButton);
                },
                tabRepositionMarker(tabButton) {
                    this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
                    this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
                    this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
                },
                tabContentActive(tabContent) { return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', ''); },
                tabButtonActive(tabContent) { const tabId = tabContent.id.split('-').slice(-1); return this.tabSelected == tabId; }
            }" x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);" class="relative w-full">

                <div x-ref="tabButtons" class="relative mb-8 inline-grid h-12 w-full select-none grid-cols-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-1 text-gray-500">
                    <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button" :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                        class="relative z-20 inline-flex h-10 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-all">フォーム情報</button>
                    <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button" :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                        class="relative z-20 inline-flex h-10 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-all">返信メール情報</button>
                    <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button" :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                        class="relative z-20 inline-flex h-10 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-all">ユーザー情報</button>
                    <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button" :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                        class="relative z-20 inline-flex h-10 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-all">ページ情報</button>
                    <div x-ref="tabMarker" class="absolute left-0 z-10 h-full w-1/2 duration-300 ease-out" x-cloak>
                        <div class="h-full w-full rounded-md bg-gray-100 shadow-sm"></div>
                    </div>
                </div>
                <div class="">

                    <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="">
                        {{-- forms --}}
                        <div class="mb-8">
                            <h4 class="text-md mb-2 font-bold text-gray-500">フォーム情報</h4>

                            {{-- create --}}
                            <div class="mb-3 flex justify-end">
                                <a href="{{ route('forms.create', 'project=' . $project->id) }}"
                                    class="focus:shadow-outline inline-flex items-center justify-center rounded-md bg-neutral-950 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                                    フォームを新規作成
                                </a>
                            </div>
                            {{-- if --}}
                            @if ($project->forms->isEmpty())
                                <div class="w-full rounded-lg border-2 border-dashed border-gray-300 px-32 py-16 text-center text-sm text-gray-600">
                                    フォームは見つかりませんでした...
                                </div>
                            @endif

                            {{-- detail --}}
                            <div>
                                @foreach ($project->forms as $form)
                                    <div class="mb-3 flex flex-col rounded-md border border-gray-300 bg-white px-8 py-4">

                                        {{-- col --}}
                                        <div class="mb-2 flex items-center justify-start gap-2 border-b border-gray-300 pb-2">

                                            {{-- form_name --}}
                                            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">
                                                <a href="{{ route('forms.show', $form->id) }}">{{ $form->form_name }}</a>
                                            </h5>

                                            {{-- input method --}}
                                            <div class="ml-auto">
                                                <a href="{{ route('forms.inputEdit', $form->id) }}" target="_blank" class="rounded border border-gray-300 px-3 py-1 text-xs" target="_blank">入力項目エディターを開く</a>
                                                <button class="rounded border border-gray-300 px-3 py-1 text-xs">投稿一覧</button>
                                                <button class="rounded border bg-red-500 px-3 py-1 text-xs text-white">PDF一括DL</button>
                                            </div>

                                            {{-- dropdown menu --}}
                                            <div x-data="{
                                                dropdownOpen: false
                                            }" class="relative">
                                                <button @click="dropdownOpen=true"
                                                    class="inline-flex h-6 items-center justify-center rounded-md bg-white px-2 text-sm font-medium transition-colors hover:bg-neutral-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50"><i
                                                        class="at-dots-vertical"></i></button>
                                                <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" class="absolute left-1/2 top-0 z-50 mt-10 w-48 -translate-x-1/2"
                                                    x-cloak>
                                                    <div class="rounded-md border border-gray-300 bg-white p-1 text-sm text-neutral-700 shadow-md">
                                                        <a href="{{ route('forms.show', $form->id) }}" @click="menuBarOpen=false"
                                                            class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                                            <span>フォームの詳細</span>
                                                        </a>
                                                        <a href="{{ route('forms.edit', $form->id) }}" @click="menuBarOpen=false"
                                                            class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                                            <span>フォームを編集</span>
                                                        </a>
                                                        <form action="{{ route('forms.duplicate', $form->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" @click="menuBarOpen=false"
                                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                                                <span>フォームを複製</span>
                                                            </button>
                                                        </form>
                                                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                                            <button @click="modalOpen=true"
                                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 text-red-500 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">フォームを削除</button>
                                                            <template x-teleport="body">
                                                                <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                                                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                                                        x-transition:leave-end="opacity-0" @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-black bg-opacity-40">
                                                                    </div>
                                                                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

                                                                        <div class="flex items-center justify-between pb-2">
                                                                            <h3 class="text-lg font-semibold">
                                                                                フォームを削除
                                                                            </h3>
                                                                            <button @click="modalOpen=false" class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 hover:bg-gray-50 hover:text-gray-800">
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
                                                                                    class="focus:shadow-outline inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
                                                                                    フォームを削除
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                                            <button @click="modalOpen=true"
                                                                class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 text-red-500 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">すべてのフォームを削除</button>
                                                            <template x-teleport="body">
                                                                <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                                                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                                                        x-transition:leave-end="opacity-0" @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-black bg-opacity-40">
                                                                    </div>
                                                                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

                                                                        <div class="flex items-center justify-between pb-2">
                                                                            <h3 class="text-lg font-semibold">
                                                                                すべてのフォームを削除
                                                                            </h3>
                                                                            <button @click="modalOpen=false" class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 hover:bg-gray-50 hover:text-gray-800">
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
                                                                            <form class="ml-auto" action="{{ route('forms.destroyAll', $form->id) }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="focus:shadow-outline inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
                                                                                    すべてのフォームを削除
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

                                        {{-- col --}}
                                        <div class="flex items-center justify-start">

                                            {{-- project_name --}}
                                            <div class="flex gap-4">
                                                <p class="text-xs text-gray-400">
                                                    {{ $project->project_name }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    入力項目：
                                                    <span class="text-gray-600">
                                                        @if ($form->input)
                                                            入力済
                                                        @else
                                                            無し
                                                        @endif
                                                    </span>
                                                </p>
                                            </div>

                                            {{-- created --}}
                                            <div class="ml-auto flex gap-4">
                                                <p class="text-xs text-gray-400">
                                                    作成日：{{ $form->created_at }}
                                                </p>
                                                <p class="text-xs text-gray-400">
                                                    更新日：{{ $form->updated_at }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                        {{-- mail --}}
                        <div class="mb-8">
                            <h4 class="text-md mb-2 font-bold text-gray-500">返信メール情報</h4>
                            <div class="rounded-md border border-gray-300 bg-white p-8">
                                <div>
                                    <div class="mb-8">
                                        <p class="mb-2 text-sm text-gray-400">メール件名</p>
                                        @if (!$project->mail_subject)
                                            <span class="text-gray-400">なし</span>
                                        @else
                                            <div class="rounded bg-gray-100 p-4 text-sm">
                                                {{ $project->mail_subject }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="mb-2 text-sm text-gray-400">メール内容</p>
                                        @if (!$project->mail_content)
                                            <span class="text-gray-400">なし</span>
                                        @else
                                            <div class="rounded bg-gray-100 p-4 text-sm">
                                                {!! $project->mail_content !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                        {{-- users --}}
                        <div class="mb-2">
                            <h4 class="text-md mb-2 font-bold text-gray-500">ユーザー情報</h4>
                            <div class="rounded-md border border-gray-300 bg-white p-8">
                                {{-- @isset($postusers)
                                    <p>アカウントは有りませんでした</p>
                                @endisset --}}
                                <table class="w-full">
                                    <tr class="broder-gray-300 border-b">
                                        <th class="pb-1 pr-6">
                                            <p class="text-left text-xs font-bold text-gray-400">氏名</p>
                                        </th>
                                        <th class="pb-1 pr-6">
                                            <p class="text-left text-xs font-bold text-gray-400">所属先</p>
                                        </th>
                                        <th class="pb-1 pr-6">
                                            <p class="text-left text-xs font-bold text-gray-400">住所</p>
                                        </th>
                                        <th class="pb-1 pr-6">
                                            <p class="text-left text-xs font-bold text-gray-400">メールアドレス</p>
                                        </th>
                                    </tr>
                                    @foreach ($postusers as $postuser)
                                        <tr class="broder-gray-300 border-b">
                                            <td class="py-2 pr-6">
                                                <p>{{ $postuser->first_name }}{{ $postuser->last_name }}</p>
                                            </td>
                                            <td class="py-2 pr-6">
                                                <p>{{ $postuser->affiliate }}</p>
                                            </td>
                                            <td class="py-2 pr-6">
                                                〒{{ $postuser->zipcode }}{{ $postuser->address_coutry }}
                                                {{ $postuser->address_city }}
                                                @if ($postuser->address_etc)
                                                    {{ $postuser->address_etc }}
                                                @endif
                                            </td>
                                            <td class="py-2 pl-3">
                                                <p>{{ $postuser->email }}</p>
                                            </td>
                                        </tr>
                            </div>
                            <div>
                            </div>
                            @endforeach
                            </table>
                        </div>
                    </div>

                </div>

                <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                    {{-- description --}}
                    <div class="mb-8">
                        <h4 class="text-md mb-2 font-bold text-gray-500">プロジェクトの説明（ユーザーページに表示されます）</h4>
                        <div class="mb-8 rounded-md border border-gray-300 bg-white p-8">

                            {{-- project message --}}
                            <div class="mb-8">
                                <p class="mb-2 text-sm text-gray-400">内容情報</p>
                                <div class="documentstyle">{!! $project->project_message !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- created / modified --}}
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
        </div>
    </main>
@endsection
