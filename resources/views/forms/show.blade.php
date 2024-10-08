@extends('layouts.master')
@section('title', 'フォームの詳細')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-neutral-800">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="mx-auto max-w-5xl p-6">

            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">フォームの詳細</h4>
                {{-- <p class="text-neutral-500 text-sm">フォームの詳細画面です。確認、編集、削除ができます</p> --}}
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

            {{-- form name / form_description / controll --}}
            <div class="mb-8 flex">

                {{-- form name / form_description --}}
                <div class="">
                    {{-- form name --}}
                    <div>
                        <p class="mb-2 text-sm text-neutral-400">フォーム名</p>
                        <h5 class="mb-2 text-2xl font-bold leading-none text-neutral-900">
                            {{ $form->form_name }}
                        </h5>
                    </div>

                    {{-- description --}}
                    <div>
                        @if (!$form->form_description)
                            <span class="text-md text-neutral-400">なし</span>
                        @else
                            <div class="text-md text-neutral-600">{!! $form->form_description !!}</div>
                        @endif
                    </div>
                </div>

                {{-- controll form --}}
                <div class="ml-auto">
                    <div x-data="{
                        dropdownOpen: false
                    }" class="relative ml-auto">

                        <button @click="dropdownOpen=true"
                            class="transition-colorsrounded-md inline-flex items-center justify-center px-4 py-2 text-lg font-medium hover:bg-neutral-100 focus:rounded focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50"><i
                                class="at-dots-vertical"></i></button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" class="absolute left-1/2 top-0 z-50 mt-10 w-44 -translate-x-1/2" x-cloak>
                            <div class="rounded-md border border-neutral-300 bg-white p-1 text-sm text-neutral-700 shadow-md">

                                {{-- edit --}}
                                <a a href="{{ route('forms.edit', $form->id) }}" @click="menuBarOpen=false"
                                    class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                    <span>フォームを編集</span>
                                </a>

                                {{-- delete --}}
                                <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50 h-auto w-auto">
                                    <button @click="modalOpen=true"
                                        class="group relative flex w-full cursor-default select-none items-center justify-between rounded px-2 py-1.5 text-red-500 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">フォームを削除</button>
                                    <template x-teleport="body">
                                        <div x-show="modalOpen" class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak>
                                            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                                @click="modalOpen=false" class="absolute inset-0 h-full w-full bg-neutral-800 bg-opacity-40">
                                            </div>
                                            <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative w-full bg-white px-7 py-6 sm:max-w-lg sm:rounded-lg">

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
                                                    <p class="text-sm text-red-500">※この操作は取り消せません</p>
                                                </div>
                                                <div class="flex">
                                                    <form class="ml-auto" action="#" method="POST">
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

            </div>

            {{-- controller buttons --}}
            <div class="mb-8">

            </div>

            {{-- input details --}}
            <div class="mb-3 rounded-md border border-neutral-300 bg-white p-8">
                入力項目が入る予定
            </div>

            {{-- created / modified --}}
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
