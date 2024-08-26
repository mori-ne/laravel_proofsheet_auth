@extends('postuser.layouts.master')
@section('title', '投稿画面 | ' . $inputs->form->project->project_name)
@section('content')
    <div class="w-full">

        <div class="relative flex w-full flex-col items-stretch">
            <!-- top -->
            <div class="bg-neutral-500 px-4">
                <div class="mx-auto flex h-12 max-w-6xl items-center gap-4">

                    <!-- form name -->
                    <div class="mr-3 flex flex-row items-center">
                        <p class="mr-2 rounded bg-neutral-600 px-2 py-0.5 text-xs font-bold text-neutral-300">フォーム名</p>
                        <h2 class="font-bold text-white">{{ $inputs->form->form_name }}</h2>
                    </div>

                </div>
            </div>

            <!-- contents -->
            <form action="{{ route('postuser.post', ['uuid' => $uuid, 'id' => $project->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="h-[calc(100% - 32px)] mx-auto flex w-full flex-col">
                    <div class="mx-auto flex h-full w-full flex-row overflow-hidden rounded bg-white">

                        <!-- preview -->
                        <div class="mx-auto flex w-full flex-1 flex-col bg-white">

                            <!-- list -->
                            <div class="h-full px-8">
                                <div class="mx-auto max-w-2xl py-10">
                                    <div class="mb-12 border-b-2 border-neutral-700">
                                        <div class="mb-4 rounded bg-neutral-100 p-8">
                                            <div class="text-sm text-neutral-500">
                                                {!! $inputs->form->form_description !!}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- inputComponent --}}
                                    @foreach ($inputComponents as $key => $inputComponent)
                                        {{-- text --}}
                                        @if ($inputComponent->inputType == 'text')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                                <input name="text-{{ $inputComponent->id }}" class="mb-1 w-full rounded border-0 bg-neutral-100 p-2 hover:bg-neutral-200" type="text" value="" />
                                                {{-- common start --}}
                                                @if ($inputComponent->inputLimit)
                                                    <p class="text-xs text-neutral-900">
                                                        000 / {{ $inputComponent->inputLimit }}&nbsp;文字
                                                    </p>
                                                @endif
                                                {{-- common end --}}
                                            </div>
                                        @endif

                                        {{-- textarea plaintext --}}
                                        @if ($inputComponent->inputType == 'textarea')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                                <textarea name="textarea-{{ $inputComponent->id }}" type="textarea" class="h-32 w-full rounded border-0 bg-neutral-100 p-2 hover:bg-neutral-200"></textarea>
                                                {{-- common start --}}
                                                @if ($inputComponent->inputLimit)
                                                    <p class="text-xs text-neutral-900">
                                                        000 / {{ $inputComponent->inputLimit }}&nbsp;文字
                                                    </p>
                                                @endif
                                                {{-- common end --}}
                                            </div>
                                        @endif

                                        {{-- textarea richtext --}}
                                        @if ($inputComponent->inputType == 'textarea_rtf')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                                <textarea id="projectinstance" name="textarea_rtf-{{ $inputComponent->id }}" type="text" placeholder="プロジェクトの概要を記入してください" class="flex h-48 min-h-[80px] w-full rounded border-0 bg-neutral-100 px-3 py-2 text-sm placeholder:text-neutral-400"></textarea>
                                                {{-- common start --}}
                                                @if ($inputComponent->inputLimit)
                                                    <p class="text-xs text-neutral-900">
                                                        000 / {{ $inputComponent->inputLimit }}&nbsp;文字
                                                    </p>
                                                @endif
                                                {{-- common end --}}
                                            </div>
                                        @endif

                                        {{-- radio --}}
                                        @if ($inputComponent->inputType == 'radio')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                                <div key="{{ $inputComponent->id }}" class="mb-1 flex flex-col items-start">
                                                    @for ($i = 0; $i < count($inputComponent->radioContent); $i++)
                                                        <div>
                                                            <input name="radio-{{ $inputComponent->id }}" type="radio" id="radio-{{ $inputComponent->id }}-{{ $i }}" value="{{ $inputComponent->radioContent[$i] }}" />
                                                            <label for="radio-{{ $inputComponent->id }}-{{ $i }}" class="text-sm">
                                                                {{ $inputComponent->radioContent[$i] }}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        {{-- checkbox --}}
                                        @if ($inputComponent->inputType == 'checkbox')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                                <div key="{{ $inputComponent->id }}" class="mb-1 flex flex-col items-start">
                                                    @for ($i = 0; $i < count($inputComponent->checkContent); $i++)
                                                        <div>
                                                            <input name="check-{{ $inputComponent->id }}" type="checkbox" id="check-{{ $inputComponent->id }}-{{ $i }}" value="{{ $inputComponent->radioContent[$i] }}" />
                                                            <label for="check-{{ $inputComponent->id }}-{{ $i }}" class="text-sm">
                                                                {{ $inputComponent->checkContent[$i] }}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        {{-- select list --}}
                                        @if ($inputComponent->inputType == 'select')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                                <div key="{{ $inputComponent->id }}" class="mb-1 flex flex-col items-start">
                                                    <select name="select-{{ $inputComponent->id }}" id="select-{{ $inputComponent->id }}" class="min-w-64 mb-1 flex flex-wrap items-center gap-1 rounded border border-neutral-200 px-2 py-1 text-sm">
                                                        <option value="選択してください">選択してください…</option>
                                                        @for ($i = 0; $i < count($inputComponent->selectContent); $i++)
                                                            <option value="{{ $inputComponent->selectContent[$i] }}">{{ $inputComponent->selectContent[$i] }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- headline --}}
                                        @if ($inputComponent->inputType == 'headline')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <h4 class="text-lg font-bold">{{ $inputComponent->inputTitle }}</h4>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                            </div>
                                        @endif

                                        {{-- paragraph --}}
                                        @if ($inputComponent->inputType == 'paragraph')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <div class="flex flex-row items-center gap-2">
                                                        <p class="text-md">{{ $inputComponent->inputTitle }}</p>
                                                        @if ($inputComponent->isRequired == true)
                                                            <p class="inline-flex h-5 items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">必須</p>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-neutral-400">{{ $inputComponent->inputLabel }}</p>
                                                </div>
                                                {{-- common end --}}
                                            </div>
                                        @endif

                                        {{-- hr --}}
                                        @if ($inputComponent->inputType == 'hr')
                                            <div class="mb-8">
                                                {{-- common start --}}
                                                <div class="mb-3">
                                                    <hr class="mb-8 mt-4 border-neutral-400" />
                                                </div>
                                                {{-- common end --}}
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- {{ dd($inputComponents) }} --}}
                                    <div class="">
                                        <button style="submit" class="w-78 mx-auto block rounded bg-neutral-600 px-4 py-1.5 font-bold text-white">投稿・更新する</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
