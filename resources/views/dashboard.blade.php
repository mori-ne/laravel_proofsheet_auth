@extends('layouts.master')
@section('title', 'ダッシュボード')
@section('content')
    <main class="h-svh flex-1 overflow-y-scroll">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-neutral-800">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="mx-auto max-w-5xl p-6">

            <div class="mb-8">
                <h4 class="text-lg font-bold text-neutral-600">ダッシュボード</h4>
                <p class="text-sm text-neutral-500"></p>
            </div>

            <div class="flex flex-row flex-wrap gap-4">

                @if (!$projects)
                    <div class="w-full rounded-lg border-2 border-dashed border-neutral-300 px-32 py-16 text-center text-sm text-neutral-600">
                        まだ何もないです...
                    </div>
                @endif

                <div class="flex-1 rounded-md border-0 border-neutral-300 bg-white px-8 py-6 shadow-md shadow-neutral-200">
                    <p class="mb-4 text-sm text-neutral-400">総プロジェクト数</p>
                    <p class="text-5xl">
                        {{ $projects->count() }}
                        <span class="text-lg text-neutral-400">件</span>
                    </p>
                </div>

                <div class="flex-1 rounded-md border-0 border-neutral-300 bg-white px-8 py-6 shadow-md shadow-neutral-200">
                    <p class="mb-4 text-sm text-neutral-400">総フォーム数</p>
                    <p class="text-5xl">
                        {{ $forms->count() }}
                        <span class="text-lg text-neutral-400">件</span>
                    </p>
                </div>

                <div class="w-full rounded-md border-0 border-neutral-300 bg-white px-8 py-6 shadow-md shadow-neutral-200">
                    <p class="mb-4 text-sm text-neutral-400">最近更新されたプロジェクト</p>
                    @foreach ($recentProjects as $recentProject)
                        <div class="mb-2 flex flex-row items-center gap-4 border-b pb-2 last:mb-0 last:border-b-0 last:pb-0">
                            <p class="text-sm text-neutral-400">
                                {{ $recentProject->updated_at }}
                            </p>
                            <a href="{{ route('projects.show', $recentProject->id) }}" class="text-lg font-bold hover:underline">
                                {{ $recentProject->project_name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
