@extends('layouts.master')
@section('title', 'ホーム')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-neutral-800">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="mx-auto max-w-5xl p-6">

            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">ホーム</h4>
                <p class="text-sm text-neutral-500"></p>
            </div>

            <div class="flex flex-col gap-3">

                @if (!$projects)
                    <div class="w-full rounded-lg border-2 border-dashed border-neutral-500 px-32 py-16 text-center text-sm text-neutral-600">
                        まだ何もないです...
                    </div>
                @endif

                <div class="flex flex-1 flex-row items-center gap-4 rounded-sm border border-neutral-200 bg-white px-8 py-4">
                    <div class="flex flex-row items-center gap-1">
                        <p class="text-2xl font-bold">{{ $projects->count() }}</p>
                        <span class="text-neutral-400">件</span>
                    </div>
                    <p class="text-sm font-bold text-neutral-500">総プロジェクト数</p>
                </div>

                <div class="flex flex-1 flex-row items-center gap-4 rounded-sm border border-neutral-200 bg-white px-8 py-4">
                    <div class="flex flex-row items-center gap-1">
                        <p class="text-2xl font-bold">{{ $forms->count() }}</p>
                        <span class="text-neutral-400">件</span>
                    </div>
                    <p class="text-sm font-bold text-neutral-500">総フォーム数</p>
                </div>

                <div class="w-full rounded-sm border border-neutral-200 bg-white px-8 py-6">
                    <p class="mb-4 text-sm font-bold text-neutral-500">最近更新されたプロジェクト</p>
                    <div class="mb-2 flex flex-row gap-4 border-b-2 border-neutral-300 pb-1">
                        <p class="w-44 text-xs font-bold text-neutral-400">更新時間</p>
                        <p class="text-xs font-bold text-neutral-500">プロジェクト名</p>
                    </div>
                    @foreach ($recentProjects as $key => $recentProject)
                        <div class="mb-2 flex flex-row items-start gap-4 border-b pb-2 last:mb-0 last:border-b-0 last:pb-0">
                            <p class="w-44 text-sm text-neutral-400">
                                {{ \Carbon\Carbon::parse($recentProject->updated_at)->format('Y年m月d日 H時i分') }}
                                {{-- {{ $recentProject->updated_at }} --}}
                            </p>
                            <div class="flex flex-row items-start">
                                <a href="{{ route('projects.show', $recentProject->id) }}" class="text-md font-bold hover:underline">
                                    {{ $recentProject->project_name }}
                                </a>
                                {{-- <p class="text-center text-sm text-neutral-400">{{ $recentProject->project_description }}</p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="w-full rounded-sm border border-neutral-200 bg-white px-8 py-6">
                    <p class="mb-4 text-sm font-bold text-neutral-500">最近更新されたフォーム</p>
                    <div class="mb-2 flex flex-row gap-4 border-b-2 border-neutral-300 pb-1">
                        <p class="w-44 text-xs font-bold text-neutral-400">更新時間</p>
                        <p class="text-xs font-bold text-neutral-500">フォーム名</p>
                    </div>
                    @foreach ($recentForms as $key => $recentForms)
                        <div class="mb-2 flex flex-row items-center gap-4 border-b pb-2 last:mb-0 last:border-b-0 last:pb-0">
                            <p class="w-44 text-sm text-neutral-400">
                                {{ \Carbon\Carbon::parse($recentForms->updated_at)->format('Y年m月d日 H時i分') }}
                                {{-- {{ $recentForms->updated_at }} --}}
                            </p>
                            <div class="min-w-32 flex flex-row items-start">
                                <a href="{{ route('projects.show', $recentForms->id) }}" class="text-md font-bold hover:underline">
                                    {{ $recentForms->form_name }}
                                </a>
                            </div>
                            <p class="ml-auto text-center text-xs text-neutral-400">{{ $recentForms->project->project_name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
