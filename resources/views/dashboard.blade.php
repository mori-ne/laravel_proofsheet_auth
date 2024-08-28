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

                <div class="flex flex-row gap-3">
                    {{-- total projects --}}
                    <div class="w-full rounded border border-neutral-200 bg-white">
                        {{-- head --}}
                        <div class="border-b border-neutral-200 px-4 py-4">
                            <p class="text-sm font-bold text-neutral-500">総プロジェクト数</p>
                        </div>
                        {{-- content --}}
                        <div class="p-6">
                            <span class="text-2xl font-bold">{{ $projects->count() }}</span>
                            <span class="text-neutral-400">件</span>
                        </div>
                    </div>

                    {{-- total forms --}}
                    <div class="w-full rounded border border-neutral-200 bg-white">
                        {{-- head --}}
                        <div class="border-b border-neutral-200 px-4 py-4">
                            <p class="text-sm font-bold text-neutral-500">総フォーム数</p>
                        </div>
                        {{-- content --}}
                        <div class="p-6">
                            <span class="text-2xl font-bold">{{ $forms->count() }}</span>
                            <span class="text-neutral-400">件</span>
                        </div>
                    </div>
                </div>

                <div class="w-full rounded border border-neutral-200 bg-white">
                    {{-- head --}}
                    <div class="border-b border-neutral-200 px-4 py-4">
                        <p class="text-sm font-bold text-neutral-500">最近更新されたプロジェクト</p>
                    </div>

                    {{-- content --}}
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-neutral-200">
                                    <th class="text-left">
                                        <p class="pb-1 text-sm font-bold text-neutral-400">更新時間</p>
                                    </th>
                                    <th class="text-left">
                                        <p class="pb-1 text-sm font-bold text-neutral-400">プロジェクト名</p>
                                    </th>
                                    <th class="text-left">
                                        <p class="pb-1 text-right text-sm font-bold text-neutral-400">コントロール</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentProjects as $key => $recentProject)
                                    <tr class="border-b border-neutral-200">
                                        <td class="w-56 py-2">
                                            {{ \Carbon\Carbon::parse($recentProject->updated_at)->format('Y年m月d日 H時i分') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('projects.show', $recentProject->id) }}" class="text-md font-bold hover:underline">
                                                {{ $recentProject->project_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="flex flex-row justify-end gap-4">
                                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('projects.show', $recentProject->id) }}">詳細</a>
                                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('projects.edit', $recentProject->id) }}">編集</a>
                                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('postuser.index', ['uuid' => $recentProject->uuid]) }}" target="_blank">投稿ページを表示</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full rounded border border-neutral-200 bg-white">

                    {{-- head --}}
                    <div class="border-b border-neutral-200 px-4 py-4">
                        <p class="text-sm font-bold text-neutral-500">最近更新されたフォーム</p>
                    </div>


                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-neutral-200">
                                    <th class="text-left">
                                        <p class="pb-1 text-sm font-bold text-neutral-400">更新時間</p>
                                    </th>
                                    <th class="text-left">
                                        <p class="pb-1 text-sm font-bold text-neutral-400">フォーム名</p>
                                    </th>
                                    <th class="text-left">
                                        <p class="pb-1 text-sm font-bold text-neutral-400">プロジェクト名</p>
                                    </th>
                                    <th class="text-right">
                                        <p class="pb-1 text-sm font-bold text-neutral-400">コントロール</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentForms as $key => $recentForms)
                                    <tr class="border-b border-neutral-200">
                                        <td class="w-56 py-2">
                                            {{ \Carbon\Carbon::parse($recentForms->updated_at)->format('Y年m月d日 H時i分') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('forms.show', $recentForms->id) }}" class="text-md font-bold hover:underline">
                                                {{ $recentForms->form_name }}
                                            </a>
                                        </td>
                                        <td class="w-0 whitespace-nowrap">
                                            <p class="text-sm">
                                                {{ $recentForms->project->project_name }}
                                            </p>
                                        </td>
                                        <td class="w-24">
                                            <div class="flex flex-row items-center justify-end gap-4">
                                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('forms.show', $recentForms->id) }}">詳細</a>
                                                <a class="text-sm text-neutral-600 hover:underline" href="{{ route('forms.edit', $recentForms->id) }}">編集</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
