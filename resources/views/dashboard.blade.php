@extends('layouts.master')
@section('title', 'ダッシュボード')
@section('content')

    {{-- top --}}
    @include('layouts.topbar')

    <div class="flex flex-row flex-nowrap">
        {{-- sidebar --}}
        @include('layouts.sidebar')

        <div class="mx-auto h-[calc(100svh_-_56px)] w-full overflow-y-scroll p-6">
            <div class="flex flex-col gap-3">

                @if (!$projects)
                    <div class="w-full rounded-lg border-2 border-dashed border-neutral-500 px-32 py-16 text-center text-sm text-neutral-600">
                        まだ何もないです...
                    </div>
                @endif

                <div class="flex flex-row gap-4">
                    <div class="flex flex-1 flex-row items-center gap-4 rounded border border-neutral-200 bg-white px-8 py-4">
                        <div class="flex flex-row items-center gap-1">
                            <p class="text-2xl font-bold">{{ $projects->count() }}</p>
                            <span class="text-neutral-400">件</span>
                        </div>
                        <p class="text-sm font-bold text-neutral-500">総プロジェクト数</p>
                    </div>

                    <div class="flex flex-1 flex-row items-center gap-4 rounded border border-neutral-200 bg-white px-8 py-4">
                        <div class="flex flex-row items-center gap-1">
                            <p class="text-2xl font-bold">{{ $forms->count() }}</p>
                            <span class="text-neutral-400">件</span>
                        </div>
                        <p class="text-sm font-bold text-neutral-500">総フォーム数</p>
                    </div>
                </div>

                <div class="w-full rounded border border-neutral-200 bg-white px-8 py-6">
                    <p class="mb-4 text-sm font-bold text-neutral-500">最近更新されたプロジェクト</p>
                    <div class="mb-2 flex flex-row gap-4 border-b-2 border-neutral-200 pb-1">
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
                            </div>
                            <div class="ml-auto flex flex-row items-center gap-4">
                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('postuser.index', ['uuid' => $recentProject->uuid]) }}" target="_blank">投稿ページを表示</a>
                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('projects.show', $recentProject->id) }}">詳細</a>
                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('projects.edit', $recentProject->id) }}">編集</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="w-full rounded border border-neutral-200 bg-white px-8 py-6">
                    <p class="mb-4 text-sm font-bold text-neutral-500">最近更新されたフォーム</p>
                    <div class="mb-2 flex flex-row gap-4 border-b-2 border-neutral-200 pb-1">
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
                                <a href="{{ route('forms.show', $recentForms->id) }}" class="text-md font-bold hover:underline">
                                    {{ $recentForms->form_name }}
                                </a>
                            </div>
                            <p class="ml-auto text-center text-xs text-neutral-300">{{ $recentForms->project->project_name }}</p>
                            <div class="flex flex-row items-center gap-4">
                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('forms.show', $recentForms->id) }}">詳細</a>
                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('forms.edit', $recentForms->id) }}">編集</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
