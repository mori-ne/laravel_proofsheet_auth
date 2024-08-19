@extends('postuser.layouts.master')
@section('title', 'ダッシュボード | ' . $input->form->project->project_name)
@section('content')
    <div class="w-full">

        <div class="relative flex w-full flex-col items-stretch">
            <!-- top -->
            <div class="flex h-12 items-center gap-4 bg-neutral-500 px-4">

                <!-- form name -->
                <div class="mr-3 flex flex-row items-center">
                    <p class="mr-2 rounded bg-neutral-600 px-2 py-0.5 text-xs font-bold text-neutral-300">フォーム名</p>
                    <h2 class="font-bold text-white">{{ $input->form->form_name }}</h2>
                </div>

                <!-- store -->
                <div class="ml-auto">
                    <form action="#">
                        <input type="hidden" name="_token" value="csrfToken" />
                        <input type="hidden" name="inputFields" placeholder="Enter name" />
                        <input type="hidden" name="form_id" value="formAttribute.id" />
                        <button type="submit" class="text-md rounded bg-neutral-800 px-3 py-1 font-bold text-white">
                            更新する
                        </button>
                    </form>
                </div>
            </div>

            <!-- contents -->
            <div class="h-[calc(100% - 32px)] mx-auto flex w-full flex-col">
                <div class="mx-auto flex h-full w-full flex-row overflow-hidden rounded-md bg-white">

                    <!-- preview -->
                    <div class="mx-auto flex w-full flex-1 flex-col bg-white">

                        <!-- list -->
                        <div class="h-full px-8">
                            <div class="mx-auto max-w-2xl py-16">
                                <div class="mb-12 border-b-2 border-neutral-700">
                                    <h1 class="mb-4 text-2xl font-bold">
                                        {{ $input->form->project->project_name }}
                                    </h1>
                                    <div class="mb-4 bg-neutral-100 p-8">
                                        <div class="text-sm text-neutral-500">
                                            {!! $input->form->form_description !!}
                                        </div>
                                    </div>
                                </div>

                                {{-- inputComponent --}}
                                {{ var_dump($input->inputs) }}
                                <ul>
                                    <li class="mb-6">

                                        {{-- common --}}
                                        <div class="flex items-center gap-2">
                                            <!-- title -->
                                            <h4 class="text-lg font-bold">
                                                タイトル
                                            </h4>

                                            <!-- required -->
                                            <p class="inline-flex items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">
                                                必須
                                            </p>
                                        </div>

                                        <!-- headline -->
                                        <h1 class="mb-2 text-xl font-bold">
                                            ヘッドライン
                                        </h1>

                                        <!-- paragraph -->
                                        <p class="mb-2">
                                            パラグラフ
                                        </p>

                                        <div class="mb-2 flex justify-between">
                                            <!-- label -->
                                            <div>
                                                <p class="text-sm text-neutral-400">
                                                    ラベル
                                                </p>
                                            </div>
                                        </div>

                                        <!-- input type -->
                                        <div>
                                            <!-- input -->
                                            <input class="mb-1 w-full rounded border-0 bg-neutral-100 p-2 hover:bg-neutral-200" type="text" value="" />

                                            <!-- textare -->
                                            <textarea type="textarea" class="h-32 w-full rounded border-0 bg-neutral-100 p-2 hover:bg-neutral-200"></textarea>


                                            <!-- checkbox -->
                                            <div>
                                                <div>
                                                    <div key="index" class="mb-1 flex flex-wrap items-center gap-1">
                                                        <input name="'check-' + inputField.id" type="checkbox" id="inputField.id + '-' + index" />
                                                        <label for="inputField.id + '-' + index" class="text-sm">value</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- radio -->
                                            <div>
                                                <div>
                                                    <div key="index" class="mb-1 flex flex-wrap items-center gap-1">
                                                        <input name="'radio-' + inputField.id" type="radio" id="inputField.id + '-' + index" />
                                                        <label for="inputField.id + '-' + index" class="text-sm">value</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- select -->
                                            <div>
                                                <div>
                                                    <select name="'select-' + inputField.id" class="mb-1 flex w-auto flex-wrap items-center gap-1 rounded border border-neutral-300 px-2 py-1 text-sm">
                                                        <option for="inputField.id + '-' + index" value="selecte" class="text-sm">
                                                            選択してください
                                                        </option>
                                                        <template key="index">
                                                            <option value="value" class="text-sm">
                                                                value
                                                            </option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- hr -->
                                            <hr class="mb-8 mt-4 border-neutral-400" />
                                        </div>

                                        <!-- limit / code -->
                                        <div class="flex">
                                            <!-- limit -->
                                            <div>
                                                <p class="text-xs text-neutral-900">
                                                    inputField . inputContent . length / inputField . inputLimit &nbsp;文字
                                                </p>
                                            </div>
                                            <!-- code -->
                                            <div class="ml-auto flex justify-end text-xs text-neutral-300">
                                                <p>code</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
