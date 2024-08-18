<script setup>
import { ref, watch, defineProps, toRefs, computed, onMounted, onUnmounted } from 'vue';
import Editor from '@tinymce/tinymce-vue';
import axios from 'axios';

/***************************************************
 * リアクティブ配列操作
 ***************************************************/

// propsの定義
const props = defineProps({
    formAttribute: Object,
    inputAttribute: Object,
    storeUrl: String,
    csrfToken: String,
});

const index = ref();

// propsから値を取得
const { formAttribute } = toRefs(props); // ref でラップする

// propsからtoRefsでreactiveなオブジェクトを作成
const { inputAttribute } = toRefs(props);

// JSONをパースしてrefに設定
let parsedInputFields;
try {
    parsedInputFields = JSON.parse(inputAttribute.value.inputs);
} catch (e) {
    console.error('Failed to parse inputAttribute.inputs:', e);
    parsedInputFields = null;
}

// 初期値の設定
const inputFields = ref(parsedInputFields);

// nullまたはundefinedなら初期値を設定
if (!inputFields.value) {
    inputFields.value = [];
    const newField = {
        id: 0,
        inputType: 'text',
        inputCode: 'code01',
        inputTitle: 'テキスト（1行）',
        inputLabel: 'テキスト（1行）のサブラベルがはいります2',
        inputLimit: 100,
        inputContent: '',
        checkContent: '',
        radioContent: '',
        selectContent: '',
        isRequired: false,
        isOpen: false,
        isShow: false,
    };
    inputFields.value.push(newField);
}

// console.log(inputFields.value);

// リアクティブ配列
// const inputFields = ref([]);

// デバッグ用フラグ
const debugFlg = ref(false);

// 初期値を適切なオプションに合わせて設定
const selectedFieldType = ref('text');

/***************************************************
 * チェックボックス処理
 ***************************************************/

const convertCheckbox = (id) => {
    // idから配列のindexを検索
    const index = inputFields.value.findIndex((field) => field.id === id);
    inputFields.value[id].checkContent = inputFields.value[index].inputContent;
    inputFields.value[id].checkContent = inputFields.value[id].checkContent
        .split(/\r?\n/)
        .map((item) => item.trim())
        .filter((item) => item);
    console.log(inputFields.value[id].checkContent);
};

/***************************************************
 * ラジオボタン処理
 ***************************************************/

const convertRadioButton = (id) => {
    // idから配列のindexを検索
    const index = inputFields.value.findIndex((field) => field.id === id);
    inputFields.value[id].radioContent = inputFields.value[index].inputContent;
    inputFields.value[id].radioContent = inputFields.value[id].radioContent
        .split(/\r?\n/)
        .map((item) => item.trim())
        .filter((item) => item);
    console.log(inputFields.value[id].radioContent);
};

/***************************************************
 * セレクトリスト操作
 ***************************************************/

const convertSelectList = (id) => {
    // idから配列のindexを検索
    const index = inputFields.value.findIndex((field) => field.id === id);
    inputFields.value[id].selectContent = inputFields.value[index].inputContent;
    inputFields.value[id].selectContent = inputFields.value[id].selectContent
        .split(/\r?\n/)
        .map((item) => item.trim())
        .filter((item) => item);
    console.log(inputFields.value[id].selectContent);
};

/***************************************************
 * コントロール処理
 ***************************************************/

// すべて開閉
const toggleAll = () => {
    const currentState = inputFields.value.every((field) => field.isOpen);
    inputFields.value.forEach((field) => {
        field.isOpen = !currentState;
    });
};

//フィールドを追加
const addField = () => {
    // 既存フィールドの最大IDを計算
    const maxId = inputFields.value.length > 0 ? Math.max(...inputFields.value.map((field) => field.id)) : -1;

    const newId = maxId + 1;

    // 初期値
    const newField = {
        id: newId,
        inputType: selectedFieldType.value,
        inputCode: `code${String(newId).padStart(2, '0')}`,
        inputTitle: `タイトル${newId + 1}`,
        inputLabel: `タイトルのサブラベルがはいります${newId + 1}`,
        inputLimit: 100, // デフォルトのリミットを設定
        inputContent: '',
        checkContent: '',
        radioContent: '',
        selectContent: '',
        isRequired: false,
        isOpen: true,
        isShow: false,
    };

    inputFields.value.push(newField);
};

//フィールドを1つ上に移動
const upField = (id) => {
    const index = inputFields.value.findIndex((field) => field.id === id);
    if (index > 0) {
        // 現在のフィールドと1つ前のフィールドを入れ替える
        [inputFields.value[index - 1], inputFields.value[index]] = [
            inputFields.value[index],
            inputFields.value[index - 1],
        ];
        // IDも一緒に入れ替える
        [inputFields.value[index - 1].id, inputFields.value[index].id] = [
            inputFields.value[index].id,
            inputFields.value[index - 1].id,
        ];
    }
};

//フィールドを1つ下に移動
const downField = (id) => {
    const index = inputFields.value.findIndex((field) => field.id === id);
    if (index < inputFields.value.length - 1) {
        // 現在のフィールドと1つ後のフィールドを入れ替える
        [inputFields.value[index + 1], inputFields.value[index]] = [
            inputFields.value[index],
            inputFields.value[index + 1],
        ];
        // IDも一緒に入れ替える
        [inputFields.value[index + 1].id, inputFields.value[index].id] = [
            inputFields.value[index].id,
            inputFields.value[index + 1].id,
        ];
    }
};

// フィールドを削除する関数
const deleteField = (id) => {
    // idに基づいてフィールドを検索し、そのインデックスを取得
    const index = inputFields.value.findIndex((field) => field.id === id);

    if (index !== -1) {
        // インデックスが見つかった場合、フィールドを削除
        inputFields.value.splice(index, 1);
    } else {
        console.error(`フィールドが見つかりませんでした: id=${id}`);
    }
    // 削除後の処理を行う場合はここに追加
};

// コントローラーの表示
const showController = (id) => {
    // idからインデックスを検索、取得
    const index = inputFields.value.findIndex((field) => field.id === id);
    inputFields.value[index].isShow = true;
};

// コントローラー非表示
const hideController = (id) => {
    // idからインデックスを検索、取得
    const index = inputFields.value.findIndex((field) => field.id === id);
    inputFields.value[index].isShow = false;
};

// ウィンドウを閉じる->実行
const doCloseWindow = () => {
    window.close();
};

// ウィンドウを閉じる際に警告を出す
const handleBeforeUnload = (event) => {
    const message = 'このページを離れますか？変更内容が保存されない可能性があります。';
    event.returnValue = message; // 標準に従った方法
    return message; // 一部のブラウザではこの戻り値を使用
};

/***************************************************
 * ウィンドウイベント
 ***************************************************/

onMounted(() => {
    window.addEventListener('beforeunload', handleBeforeUnload);
});

onUnmounted(() => {
    window.removeEventListener('beforeunload', handleBeforeUnload);
});

const submitForm = () => {
    const path = __PROJECT_ROOT__;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(csrfToken);
    console.log(JSON.stringify(inputFields.value));
    console.log(formAttribute.value.id);
    // inputFieldsをJSON形式に変換して送信;
    axios
        .post(path + '/admin/forms/inputs/' + formAttribute.value.id + '/store', {
            _token: csrfToken,
            inputFields: JSON.stringify(inputFields.value),
            form_id: formAttribute.value.id,
        })
        .then((response) => {
            console.log(response.data);
            window.alert('保存しました。');
        })
        .catch((error) => {
            console.error(error);
        });
};
</script>

<template>
    <div class="relative flex h-svh w-full flex-col items-stretch">
        <!-- top -->
        <div class="flex h-10 items-center gap-4 bg-neutral-500 px-4">
            <!-- title -->
            <div class="mr-3">
                <p class="font-bold text-white">入力項目編集画面</p>
            </div>

            <!-- project name -->
            <div class="mr-3 flex flex-row items-center">
                <p class="mr-2 rounded bg-neutral-600 px-2 py-0.5 text-xs font-bold text-neutral-300">プロジェクト名</p>
                <h2 class="text-md font-bold text-white">
                    {{ formAttribute.project.project_name }}
                </h2>
            </div>

            <!-- form name -->
            <div class="flex flex-row items-center">
                <p class="mr-2 rounded bg-neutral-600 px-2 py-0.5 text-xs font-bold text-neutral-300">フォーム名</p>
                <h2 class="text-md font-bold text-white">
                    {{ formAttribute.form_name }}
                </h2>
            </div>

            <!-- debug -->
            <div class="ml-auto">
                <input
                    v-model="debugFlg"
                    name="debugSwitch"
                    type="checkbox"
                    class="h-4 w-4 rounded-sm border border-neutral-300"
                />
                <label for="debugSwitch" class="clear-start pl-1 text-sm text-white">Debug</label>
            </div>

            <!-- store -->
            <div>
                <form @submit.prevent="submitForm">
                    <input type="hidden" name="_token" :value="csrfToken" />
                    <input type="hidden" name="inputFields" v-model="inputFields" placeholder="Enter name" />
                    <input type="hidden" name="form_id" :value="formAttribute.id" />
                    <button type="submit" class="text-md rounded bg-neutral-800 px-3 py-1 font-bold text-white">
                        更新する
                    </button>
                </form>
            </div>
        </div>

        <!-- contents -->
        <div class="h-[calc(100% - 32px)] mx-auto flex w-full flex-col overflow-hidden">
            <div class="mx-auto flex h-full w-full flex-row overflow-hidden rounded-md bg-white">
                <!-- set -->
                <div class="relative flex w-96 flex-shrink-0 flex-col overflow-y-scroll bg-neutral-100">
                    <!-- title -->
                    <div class="shrink-0 border-b border-neutral-300 bg-white px-4 py-2 text-neutral-500">
                        <h3 class="text-lg font-bold">セット項目</h3>
                    </div>

                    <!-- select field -->
                    <div class="relative z-10 shrink-0 border-b border-neutral-300 bg-white p-4 shadow-neutral-300">
                        <select
                            v-model="selectedFieldType"
                            class="mb-2 w-full rounded border border-neutral-300 px-2 py-1"
                            name=""
                            id=""
                        >
                            <option value="text">テキスト（1行）</option>
                            <option value="textarea">テキストエリア（標準）</option>
                            <option value="textarea_rtf">テキストエリア（RTF）</option>
                            <option value="checkbox">チェックリスト</option>
                            <option value="radio">ラジオボタン</option>
                            <option value="select">セレクトリスト</option>
                            <option value="headline">見出し</option>
                            <option value="paragraph">段落</option>
                            <option value="hr">罫線</option>
                        </select>
                        <div class="flex justify-end gap-3">
                            <button @click="toggleAll" type="button" class="text-xs text-neutral-500">
                                すべて開く / すべて閉じる
                            </button>
                            <button
                                @click="addField"
                                class="rounded bg-neutral-600 px-2 py-1 text-xs text-white"
                                type="button"
                            >
                                フィールドを追加
                            </button>
                        </div>
                    </div>

                    <!-- input field -->
                    <ul class="relative h-full overflow-y-scroll">
                        <li
                            :class="{
                                'sticky top-0 bg-white': inputField.isOpen,
                                'relative w-full border-b border-neutral-300': true,
                            }"
                            v-for="inputField in inputFields"
                            :key="inputField.id"
                            v-on:mouseover="showController(inputField.id)"
                            v-on:mouseleave="hideController(inputField.id)"
                            class="w-full border-b border-neutral-300"
                        >
                            <div
                                class="flex flex-row items-start justify-between gap-2 bg-white px-4 py-3 hover:bg-neutral-100"
                            >
                                <!-- input field title -->
                                <div class="w-full">
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'text'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div class="flex flex-col">
                                            <h6 v-text="inputField.inputTitle"></h6>
                                            <p class="text-xs text-neutral-400">テキスト（1行）</p>
                                        </div>
                                        <!-- <span class="ml-auto w-4 text-center text-xs text-neutral-300">{{
                                            inputField.id
                                        }}</span> -->
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'textarea'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <h6 v-text="inputField.inputTitle"></h6>
                                            <p class="text-xs text-neutral-400">テキストエリア（標準）</p>
                                        </div>
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'textarea_rtf'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <h6 v-text="inputField.inputTitle"></h6>
                                            <p class="text-xs text-neutral-400">テキストエリア（RTF）</p>
                                        </div>
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'checkbox'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <h6 v-text="inputField.inputTitle"></h6>
                                            <p class="text-xs text-neutral-400">チェックリスト</p>
                                        </div>
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'radio'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <p v-text="inputField.inputTitle"></p>
                                            <p class="text-xs text-neutral-400">ラジオボタン</p>
                                        </div>
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'select'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <p v-text="inputField.inputTitle"></p>
                                            <p class="text-xs text-neutral-400">セレクトリスト</p>
                                        </div>
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'headline'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <p v-text="inputField.inputTitle"></p>
                                            <p class="text-xs text-neutral-400">見出し</p>
                                        </div>
                                    </div>
                                    <div
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        v-if="inputField.inputType === 'paragraph'"
                                        class="flex cursor-pointer items-center gap-2 font-bold"
                                    >
                                        <div>
                                            <p v-text="inputField.inputTitle"></p>
                                            <p class="text-xs text-neutral-400">段落</p>
                                        </div>
                                    </div>
                                    <div v-if="inputField.inputType === 'hr'" class="flex items-center gap-1 font-bold">
                                        <p>罫線</p>
                                        <span class="ml-auto w-4 text-center text-xs text-neutral-300">{{
                                            inputField.id
                                        }}</span>
                                    </div>
                                </div>

                                <!-- controller -->
                                <div v-if="inputField.isShow" class="ml-auto flex items-center gap-2">
                                    <button @click="upField(inputField.id)" type="button" class="text-sm">
                                        <i class="at-arrow-up-circle"></i>
                                    </button>
                                    <button @click="downField(inputField.id)" type="button" class="text-sm">
                                        <i class="at-arrow-down-circle"></i>
                                    </button>
                                    <button
                                        @click="deleteField(inputField.id)"
                                        type="button"
                                        class="text-sm text-red-500"
                                    >
                                        <i class="at-xmark-circle"></i>
                                    </button>
                                    <button
                                        @click="inputField.isOpen = !inputField.isOpen"
                                        type="button"
                                        class="text-sm text-neutral-500"
                                    >
                                        <!-- {{ inputField.isOpen ? '閉じる' : '開く' }} -->
                                        <i class="at-info-circle"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- detail -->
                            <Transition>
                                <div v-if="inputField.isOpen" id="detail" class="p-4">
                                    <!-- title -->
                                    <div v-if="!(inputField.inputType === 'hr')" class="mb-2">
                                        <p class="mb-1 text-xs text-neutral-500">タイトル</p>
                                        <input
                                            v-model="inputField.inputTitle"
                                            class="w-full rounded border border-neutral-300 px-2 py-1 text-sm placeholder:text-gray-200"
                                            type="text"
                                            placeholder="タイトル"
                                        />
                                    </div>

                                    <!-- sub label -->
                                    <div v-if="!(inputField.inputType === 'hr')" class="mb-2">
                                        <p class="mb-1 text-xs text-neutral-500">サブラベル</p>
                                        <input
                                            v-model="inputField.inputLabel"
                                            class="w-full rounded border border-neutral-300 px-2 py-1 text-sm"
                                            type="text"
                                            value=""
                                            placeholder="サブラベルが入ります"
                                        />
                                    </div>

                                    <!-- checkbox -->
                                    <div v-if="inputField.inputType === 'checkbox'" class="mb-2">
                                        <div>
                                            <p class="mb-1 text-xs text-neutral-500">チェックリスト（1行で1つ）</p>
                                            <textarea
                                                v-model="inputField.inputContent"
                                                @input="convertCheckbox(inputField.id)"
                                                class="w-full rounded border border-neutral-300 px-2 py-1 text-sm"
                                                name=""
                                                id=""
                                                cols="10"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- radio -->
                                    <div v-if="inputField.inputType === 'radio'" class="mb-2">
                                        <div>
                                            <p class="mb-1 text-xs text-neutral-500">ラジオボタン（1行で1つ）</p>
                                            <textarea
                                                v-model="inputField.inputContent"
                                                @input="convertRadioButton(inputField.id)"
                                                class="w-full rounded border border-neutral-300 px-2 py-1 text-sm"
                                                name=""
                                                id=""
                                                cols="10"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- checkbox -->
                                    <div v-if="inputField.inputType === 'select'" class="mb-2">
                                        <div>
                                            <p class="mb-1 text-xs text-neutral-500">セレクトリスト（1行で1つ）</p>
                                            <textarea
                                                v-model="inputField.inputContent"
                                                @input="convertSelectList(inputField.id)"
                                                class="w-full rounded border border-neutral-300 px-2 py-1 text-sm"
                                                name=""
                                                id=""
                                                cols="10"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- code / limit / required -->
                                    <div class="flex gap-2">
                                        <!-- code -->
                                        <div v-if="!(inputField.inputType === 'hr')" class="mb-2 w-20">
                                            <p class="mb-1 text-xs text-neutral-500">コード</p>
                                            <input
                                                v-model="inputField.inputCode"
                                                class="w-full rounded border border-neutral-300 px-2 py-1 text-sm"
                                                type="text"
                                                placeholder="code00"
                                            />
                                        </div>

                                        <!-- limit -->
                                        <div
                                            v-if="
                                                !(
                                                    inputField.inputType === 'checkbox' ||
                                                    inputField.inputType === 'radio' ||
                                                    inputField.inputType === 'select' ||
                                                    inputField.inputType === 'headline' ||
                                                    inputField.inputType === 'paragraph' ||
                                                    inputField.inputType === 'hr'
                                                )
                                            "
                                            class="mb-2 w-16"
                                        >
                                            <p class="mb-1 text-xs text-neutral-500">文字数制限</p>
                                            <input
                                                v-model="inputField.inputLimit"
                                                class="w-28 rounded border border-neutral-300 px-2 py-1 text-sm"
                                                type="number"
                                                placeholder="100"
                                            />
                                        </div>

                                        <!-- required -->
                                        <div
                                            v-if="
                                                !(
                                                    inputField.inputType === 'paragraph' ||
                                                    inputField.inputType === 'headline' ||
                                                    inputField.inputType === 'hr'
                                                )
                                            "
                                            class="mb-2 shrink-0"
                                        >
                                            <p class="mb-1 text-xs text-neutral-500">必須</p>
                                            <input
                                                v-model="inputField.isRequired"
                                                class="h-4 w-4 rounded border-neutral-400"
                                                type="checkbox"
                                                name="required"
                                                value="必須"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </Transition>
                        </li>
                    </ul>
                </div>

                <!-- preview -->
                <div class="mx-auto flex w-full flex-1 flex-col bg-white">
                    <!-- title -->
                    <!-- <div class="shrink-0 border-b border-neutral-300 bg-white p-4 text-neutral-500">
                        <h3 class="text-lg font-bold">プレビュー</h3>
                    </div> -->

                    <!-- list -->
                    <div class="h-full overflow-y-scroll border-l px-8">
                        <div class="mx-auto max-w-2xl py-16">
                            <div class="mb-12 border-b-2 border-neutral-700">
                                <h1 class="mb-4 text-2xl font-bold">
                                    {{ formAttribute.project.project_name }}
                                </h1>
                                <div class="mb-4 bg-neutral-100 p-8">
                                    <p class="text-sm text-neutral-500" v-html="formAttribute.form_description"></p>
                                </div>
                            </div>

                            <ul>
                                <li v-for="inputField in inputFields" :key="inputField.id" class="mb-6">
                                    <div class="flex items-center gap-2">
                                        <!-- title -->
                                        <h4
                                            v-if="
                                                !(
                                                    inputField.inputType === 'headline' ||
                                                    inputField.inputType === 'paragraph' ||
                                                    inputField.inputType === 'hr'
                                                )
                                            "
                                            class="text-lg font-bold"
                                        >
                                            {{ inputField.inputTitle }}
                                        </h4>

                                        <!-- required -->
                                        <p
                                            v-if="inputField.isRequired"
                                            class="inline-flex items-center justify-center rounded-full bg-red-500 px-2 py-0.5 text-xs text-white"
                                        >
                                            必須
                                        </p>
                                    </div>

                                    <!-- headline -->
                                    <h1 v-if="inputField.inputType === 'headline'" class="mb-2 text-xl font-bold">
                                        {{ inputField.inputTitle }}
                                    </h1>

                                    <!-- paragraph -->
                                    <p v-if="inputField.inputType === 'paragraph'" class="mb-2">
                                        {{ inputField.inputTitle }}
                                    </p>

                                    <div class="mb-2 flex justify-between">
                                        <!-- label -->
                                        <div v-if="!(inputField.inputType === 'hr')">
                                            <p class="text-sm text-neutral-400">
                                                {{ inputField.inputLabel }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- input type -->
                                    <div>
                                        <!-- input -->
                                        <input
                                            v-if="inputField.inputType === 'text'"
                                            v-model="inputField.inputContent"
                                            class="mb-1 w-full rounded border-0 bg-neutral-100 p-2 hover:bg-neutral-200"
                                            type="text"
                                            value=""
                                        />

                                        <!-- textare -->
                                        <textarea
                                            v-if="inputField.inputType === 'textarea'"
                                            type="textarea"
                                            v-model="inputField.inputContent"
                                            class="h-32 w-full rounded border-0 bg-neutral-100 p-2 hover:bg-neutral-200"
                                        ></textarea>

                                        <Editor
                                            v-if="inputField.inputType === 'textarea_rtf'"
                                            v-model="inputField.inputContent"
                                            api-key="9vs0qfvaptabc555wnnfa7azwz22jq0pykxs1j8x8t1pcb0i"
                                            :init="{
                                                plugins: 'lists link code help wordcount',
                                                menubar: 'none',
                                            }"
                                        />

                                        <!-- checkbox -->
                                        <div v-if="inputField.inputType === 'checkbox'">
                                            <div v-if="inputField.inputContent">
                                                <div
                                                    v-for="(value, index) in inputField.checkContent"
                                                    :key="index"
                                                    class="mb-1 flex flex-wrap items-center gap-1"
                                                >
                                                    <input
                                                        v-bind:name="'check-' + inputField.id"
                                                        type="checkbox"
                                                        v-bind:id="inputField.id + '-' + index"
                                                    />
                                                    <label v-bind:for="inputField.id + '-' + index" class="text-sm">{{
                                                        value
                                                    }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- radio -->
                                        <div v-if="inputField.inputType === 'radio'">
                                            <div v-if="inputField.inputContent">
                                                <div
                                                    v-for="(value, index) in inputField.radioContent"
                                                    :key="index"
                                                    class="mb-1 flex flex-wrap items-center gap-1"
                                                >
                                                    <input
                                                        v-bind:name="'radio-' + inputField.id"
                                                        type="radio"
                                                        v-bind:id="inputField.id + '-' + index"
                                                    />
                                                    <label v-bind:for="inputField.id + '-' + index" class="text-sm">{{
                                                        value
                                                    }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- select -->
                                        <div v-if="inputField.inputType === 'select'">
                                            <div v-if="inputField.inputContent">
                                                <select
                                                    v-bind:name="'select-' + inputField.id"
                                                    class="mb-1 flex w-auto flex-wrap items-center gap-1 rounded border border-neutral-300 px-2 py-1 text-sm"
                                                >
                                                    <option
                                                        v-bind:for="inputField.id + '-' + index"
                                                        value="selecte"
                                                        class="text-sm"
                                                    >
                                                        選択してください
                                                    </option>
                                                    <template
                                                        v-for="(value, index) in inputField.selectContent"
                                                        :key="index"
                                                    >
                                                        <option
                                                            v-bind:for="inputField.id + '-' + index"
                                                            v-bind:value="value"
                                                            class="text-sm"
                                                        >
                                                            {{ value }}
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- hr -->
                                        <hr v-if="inputField.inputType === 'hr'" class="mb-8 mt-4 border-neutral-400" />
                                    </div>

                                    <!-- limit / code -->
                                    <div class="flex">
                                        <!-- limit -->
                                        <div
                                            v-if="
                                                inputField.inputType === 'text' ||
                                                inputField.inputType === 'textarea' ||
                                                inputField.inputType === 'textarea_rtf'
                                            "
                                        >
                                            <p v-if="!inputField.inputLimit == 0" class="text-xs text-neutral-900">
                                                {{ inputField.inputContent.length }}
                                                /
                                                {{ inputField.inputLimit }}&nbsp;文字
                                            </p>
                                        </div>
                                        <!-- code -->
                                        <div
                                            v-if="!(inputField.inputType === 'hr')"
                                            class="ml-auto flex justify-end text-xs text-neutral-300"
                                        >
                                            <p v-text="inputField.inputCode"></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- debug -->
                <div
                    v-if="debugFlg"
                    class="w-80 overflow-y-scroll break-all border-0 bg-neutral-100 p-4"
                    style="font-size: 9px"
                >
                    <p style="white-space: pre-wrap">
                        {{ inputFields }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="css">
.v-enter-active,
.v-leave-active {
    transition: all 0.3s ease;
    overflow: hidden;
}
.v-enter-from,
.v-leave-to {
    height: 0;
}
.v-enter-to,
.v-leave-from {
    height: 250px;
}

/* li:last-child {
border: none;
} */
</style>
