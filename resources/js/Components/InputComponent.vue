<script setup>
import {
    ref,
    watch,
    defineProps,
    toRefs,
    computed,
    onMounted,
    onUnmounted,
} from "vue";
import Editor from "@tinymce/tinymce-vue";
import axios from "axios";

/***************************************************
 * リアクティブ配列操作
 ***************************************************/

// propsの定義
const props = defineProps({
    formAttribute: Object,
    inputAttribute: Object,
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
    console.error("Failed to parse inputAttribute.inputs:", e);
    parsedInputFields = null;
}

// 初期値の設定
const inputFields = ref(parsedInputFields);

// nullまたはundefinedなら初期値を設定
if (!inputFields.value) {
    inputFields.value = [];
    const newField = {
        id: 0,
        inputType: "text",
        inputCode: "code01",
        inputTitle: "テキスト（1行）",
        inputLabel: "テキスト（1行）のサブラベルがはいります2",
        inputLimit: 100,
        inputContent: "",
        checkContent: "",
        radioContent: "",
        selectContent: "",
        isRequired: false,
        isOpen: false,
        isShow: false,
    };
    inputFields.value.push(newField);
}

console.log(inputFields.value);

// リアクティブ配列
// const inputFields = ref([]);

// デバッグ用フラグ
const debugFlg = ref(false);

// 初期値を適切なオプションに合わせて設定
const selectedFieldType = ref("text");

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
    const maxId =
        inputFields.value.length > 0
            ? Math.max(...inputFields.value.map((field) => field.id))
            : -1;

    const newId = maxId + 1;

    // 初期値
    const newField = {
        id: newId,
        inputType: selectedFieldType.value,
        inputCode: `code${String(newId).padStart(2, "0")}`,
        inputTitle: `タイトル${newId + 1}`,
        inputLabel: `タイトルのサブラベルがはいります${newId + 1}`,
        inputLimit: 100, // デフォルトのリミットを設定
        inputContent: "",
        checkContent: "",
        radioContent: "",
        selectContent: "",
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
    const message =
        "このページを離れますか？変更内容が保存されない可能性があります。";
    event.returnValue = message; // 標準に従った方法
    return message; // 一部のブラウザではこの戻り値を使用
};

/***************************************************
 * ウィンドウイベント
 ***************************************************/

onMounted(() => {
    window.addEventListener("beforeunload", handleBeforeUnload);
});

onUnmounted(() => {
    window.removeEventListener("beforeunload", handleBeforeUnload);
});

/***************************************************
 * 更新処理
 ***************************************************/
const response = ref("");
const sendData = async () => {
    try {
        const url = `/forms/inputs/submit/${formAttribute.value.id}`;
        console.log("Sending request to:", url); // デバッグ用
        const res = await axios.post(url, inputFields.value, {
            headers: {
                "Content-Type": "application/json",
            },
        });
        response.value = res.data.message;
    } catch (error) {
        console.error("Error sending data:", error);
    }
};
</script>

<template>
    <div class="min-h-screen w-full bg-gray-100 relative">
        <div class="max-w-7xl mx-auto p-8 flex flex-col">
            <!-- <pre v-text="formAttribute" class="text-xs"></pre> -->
            <!-- <pre v-text="inputFields" class="text-xs"></pre> -->

            <!-- top -->
            <div class="mb-4">
                <div class="flex gap-4 border-b border-gray-300 pb-2">
                    <p class="text-lg text-gray-900 font-bold">
                        入力項目編集画面
                    </p>
                    <!-- <button
                        @click="doCloseWindow"
                        class="text-sm text-red-600 bg-white px-2 rounded-md hover:bg-gray-500 ml-auto"
                    >
                        <i class="at-xmark-circle"></i>
                        閉じる
                    </button> -->
                </div>

                <!-- プロジェクト・フォーム -->
                <div class="flex gap-4 pt-2">
                    <div class="flex flex-row items-center">
                        <p class="text-sm text-gray-400">プロジェクト名：</p>
                        <h2 class="text-sm text-gray-900 font-bold">
                            {{ formAttribute.project.project_name }}
                        </h2>
                    </div>
                    <div class="flex flex-row items-center">
                        <p class="text-sm text-gray-400">フォーム名：</p>
                        <h2 class="text-sm text-gray-900 font-bold">
                            {{ formAttribute.form_name }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- デバッグモード -->
            <div class="flex justify-end space-x-2 mb-2 ml-auto">
                <input
                    v-model="debugFlg"
                    name="debugSwitch"
                    type="checkbox"
                    class="w-4 h-4 border rounded-sm border-gray-300 ml-auto mr-2"
                />
                <label for="debugSwitch" class="text-xs">
                    デバッグモード
                </label>
            </div>
            <div
                class="w-full mx-auto flex flex-row bg-white border border-gray-300 rounded-lg overflow-hidden mb-14"
            >
                <!-- セット項目 -->
                <div
                    class="flex-shrink-0 bg-white w-80 border-r border-gray-300"
                >
                    <!-- title -->
                    <div
                        class="text-gray-500 p-4 border-b border-gray-300 bg-white"
                    >
                        <h3 class="font-bold text-xl">セット項目</h3>
                    </div>

                    <!-- select field -->
                    <div class="p-4 border-b border-gray-300 bg-white">
                        <select
                            v-model="selectedFieldType"
                            class="border rounded py-1 px-2 w-full mb-2 border-gray-300"
                            name=""
                            id=""
                        >
                            <option value="text">テキスト（1行）</option>
                            <option value="textarea">
                                テキストエリア（標準）
                            </option>
                            <option value="textarea_rtf">
                                テキストエリア（RTF）
                            </option>
                            <option value="checkbox">チェックリスト</option>
                            <option value="radio">ラジオボタン</option>
                            <option value="select">セレクトリスト</option>
                            <option value="headline">見出し</option>
                            <option value="paragraph">段落</option>
                            <option value="hr">罫線</option>
                        </select>
                        <div class="flex justify-end gap-3">
                            <button
                                @click="toggleAll"
                                type="button"
                                class="text-xs text-gray-500"
                            >
                                すべて開く / すべて閉じる
                            </button>
                            <button
                                @click="addField"
                                class="rounded py-1 px-2 text-xs bg-gray-700 text-white"
                                type="button"
                            >
                                フィールドを追加
                            </button>
                        </div>
                    </div>

                    <!-- input field -->
                    <ul>
                        <li
                            :class="{
                                'sticky top-0 bg-white': inputField.isOpen,
                                'w-full border-b border-gray-300 relative': true,
                            }"
                            v-for="inputField in inputFields"
                            :key="inputField.id"
                            v-on:mouseover="showController(inputField.id)"
                            v-on:mouseleave="hideController(inputField.id)"
                            class="w-full border-b border-gray-300"
                        >
                            <div
                                class="flex flex-row gap-2 justify-between items-center p-4 bg-white"
                            >
                                <!-- input field title -->
                                <div class="w-full">
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="inputField.inputType === 'text'"
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>テキスト（1行）</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="
                                            inputField.inputType === 'textarea'
                                        "
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>テキストエリア（標準）</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="
                                            inputField.inputType ===
                                            'textarea_rtf'
                                        "
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>テキストエリア（RTF）</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="
                                            inputField.inputType === 'checkbox'
                                        "
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>チェックリスト</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="inputField.inputType === 'radio'"
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>ラジオボタン</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="inputField.inputType === 'select'"
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>セレクトリスト</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="
                                            inputField.inputType === 'headline'
                                        "
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>見出し</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        v-if="
                                            inputField.inputType === 'paragraph'
                                        "
                                        class="font-bold cursor-pointer flex gap-2 items-center"
                                    >
                                        <p>段落</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                    <div
                                        v-if="inputField.inputType === 'hr'"
                                        class="font-bold flex gap-1 items-center"
                                    >
                                        <p>罫線</p>
                                        <span
                                            class="w-4 text-center text-xs text-gray-300 ml-auto"
                                            >{{ inputField.id }}</span
                                        >
                                    </div>
                                </div>

                                <!-- controller -->
                                <div
                                    v-if="inputField.isShow"
                                    class="ml-auto flex gap-2 items-center"
                                >
                                    <button
                                        @click="upField(inputField.id)"
                                        type="button"
                                        class="text-sm"
                                    >
                                        <i class="at-arrow-up-circle"></i>
                                    </button>
                                    <button
                                        @click="downField(inputField.id)"
                                        type="button"
                                        class="text-sm"
                                    >
                                        <i class="at-arrow-down-circle"></i>
                                    </button>
                                    <button
                                        @click="deleteField(inputField.id)"
                                        type="button"
                                        class="text-red-500 text-sm"
                                    >
                                        <i class="at-xmark-circle"></i>
                                    </button>
                                    <button
                                        @click="
                                            inputField.isOpen =
                                                !inputField.isOpen
                                        "
                                        type="button"
                                        class="text-gray-500 text-sm"
                                    >
                                        <!-- {{ inputField.isOpen ? '閉じる' : '開く' }} -->
                                        <i class="at-info-circle"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- detail -->
                            <Transition>
                                <div
                                    v-if="inputField.isOpen"
                                    id="detail"
                                    class="p-4"
                                >
                                    <!-- title -->
                                    <div
                                        v-if="!(inputField.inputType === 'hr')"
                                        class="mb-2"
                                    >
                                        <p class="text-xs text-gray-500 mb-1">
                                            タイトル
                                        </p>
                                        <input
                                            v-model="inputField.inputTitle"
                                            class="border border-gray-300 rounded w-full py-1 px-2 text-sm"
                                            type="text"
                                            placeholder="タイトル"
                                        />
                                    </div>

                                    <!-- sub label -->
                                    <div
                                        v-if="!(inputField.inputType === 'hr')"
                                        class="mb-2"
                                    >
                                        <p class="text-xs text-gray-500 mb-1">
                                            サブラベル
                                        </p>
                                        <input
                                            v-model="inputField.inputLabel"
                                            class="border border-gray-300 rounded w-full py-1 px-2 text-sm"
                                            type="text"
                                            value=""
                                            placeholder="サブラベルが入ります"
                                        />
                                    </div>

                                    <!-- checkbox -->
                                    <div
                                        v-if="
                                            inputField.inputType === 'checkbox'
                                        "
                                        class="mb-2"
                                    >
                                        <div>
                                            <p
                                                class="text-xs text-gray-500 mb-1"
                                            >
                                                チェックリスト（1行で1つ）
                                            </p>
                                            <textarea
                                                v-model="
                                                    inputField.inputContent
                                                "
                                                @input="
                                                    convertCheckbox(
                                                        inputField.id
                                                    )
                                                "
                                                class="w-full border rounded border-gray-300 text-sm px-2 py-1"
                                                name=""
                                                id=""
                                                cols="10"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- radio -->
                                    <div
                                        v-if="inputField.inputType === 'radio'"
                                        class="mb-2"
                                    >
                                        <div>
                                            <p
                                                class="text-xs text-gray-500 mb-1"
                                            >
                                                ラジオボタン（1行で1つ）
                                            </p>
                                            <textarea
                                                v-model="
                                                    inputField.inputContent
                                                "
                                                @input="
                                                    convertRadioButton(
                                                        inputField.id
                                                    )
                                                "
                                                class="w-full border rounded border-gray-300 text-sm px-2 py-1"
                                                name=""
                                                id=""
                                                cols="10"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- checkbox -->
                                    <div
                                        v-if="inputField.inputType === 'select'"
                                        class="mb-2"
                                    >
                                        <div>
                                            <p
                                                class="text-xs text-gray-500 mb-1"
                                            >
                                                セレクトリスト（1行で1つ）
                                            </p>
                                            <textarea
                                                v-model="
                                                    inputField.inputContent
                                                "
                                                @input="
                                                    convertSelectList(
                                                        inputField.id
                                                    )
                                                "
                                                class="w-full border rounded border-gray-300 text-sm px-2 py-1"
                                                name=""
                                                id=""
                                                cols="10"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- code / limit / required -->
                                    <div class="flex gap-2">
                                        <!-- code -->
                                        <div
                                            v-if="
                                                !(inputField.inputType === 'hr')
                                            "
                                            class="mb-2 w-20"
                                        >
                                            <p
                                                class="text-xs text-gray-500 mb-1"
                                            >
                                                コード
                                            </p>
                                            <input
                                                v-model="inputField.inputCode"
                                                class="border border-gray-300 rounded w-full py-1 px-2 text-sm"
                                                type="text"
                                                placeholder="code00"
                                            />
                                        </div>

                                        <!-- limit -->
                                        <div
                                            v-if="
                                                !(
                                                    inputField.inputType ===
                                                        'checkbox' ||
                                                    inputField.inputType ===
                                                        'radio' ||
                                                    inputField.inputType ===
                                                        'select' ||
                                                    inputField.inputType ===
                                                        'headline' ||
                                                    inputField.inputType ===
                                                        'paragraph' ||
                                                    inputField.inputType ===
                                                        'hr'
                                                )
                                            "
                                            class="w-16 mb-2"
                                        >
                                            <p
                                                class="text-xs text-gray-500 mb-1"
                                            >
                                                文字数制限
                                            </p>
                                            <input
                                                v-model="inputField.inputLimit"
                                                class="border border-gray-300 rounded w-28 py-1 px-2 text-sm"
                                                type="number"
                                                placeholder="100"
                                            />
                                        </div>

                                        <!-- required -->
                                        <div
                                            v-if="
                                                !(
                                                    inputField.inputType ===
                                                        'paragraph' ||
                                                    inputField.inputType ===
                                                        'headline' ||
                                                    inputField.inputType ===
                                                        'hr'
                                                )
                                            "
                                            class="mb-2 shrink-0"
                                        >
                                            <p
                                                class="text-xs text-gray-500 mb-1"
                                            >
                                                必須
                                            </p>
                                            <input
                                                v-model="inputField.isRequired"
                                                class="w-4 h-4 border-gray-400 rounded"
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
                <div class="flex-1 mx-auto bg-white w-full">
                    <!-- title -->
                    <div
                        class="text-gray-500 p-4 border-b border-gray-300 bg-white"
                    >
                        <h3 class="font-bold text-xl">プレビュー</h3>
                    </div>

                    <!-- list -->
                    <div class="px-8">
                        <div class="max-w-2xl mx-auto py-8">
                            <ul>
                                <li
                                    v-for="inputField in inputFields"
                                    :key="inputField.id"
                                    class="mb-8"
                                >
                                    <div class="flex gap-2 items-center">
                                        <!-- title -->
                                        <h4
                                            v-if="
                                                !(
                                                    inputField.inputType ===
                                                        'headline' ||
                                                    inputField.inputType ===
                                                        'paragraph' ||
                                                    inputField.inputType ===
                                                        'hr'
                                                )
                                            "
                                            class="font-bold text-lg"
                                        >
                                            {{ inputField.inputTitle }}
                                        </h4>

                                        <!-- required -->
                                        <p
                                            v-if="inputField.isRequired"
                                            class="bg-red-500 text-white text-xs inline-flex items-center justify-center py-0.5 px-2 rounded-full"
                                        >
                                            必須
                                        </p>
                                    </div>

                                    <!-- headline -->
                                    <h1
                                        v-if="
                                            inputField.inputType === 'headline'
                                        "
                                        class="text-xl font-bold mb-2"
                                    >
                                        {{ inputField.inputTitle }}
                                    </h1>

                                    <!-- paragraph -->
                                    <p
                                        v-if="
                                            inputField.inputType === 'paragraph'
                                        "
                                        class="mb-2"
                                    >
                                        {{ inputField.inputTitle }}
                                    </p>

                                    <div class="flex justify-between mb-2">
                                        <!-- label -->
                                        <div
                                            v-if="
                                                !(inputField.inputType === 'hr')
                                            "
                                        >
                                            <p class="text-sm text-gray-400">
                                                {{ inputField.inputLabel }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- input type -->
                                    <div>
                                        <!-- input -->
                                        <input
                                            v-if="
                                                inputField.inputType === 'text'
                                            "
                                            v-model="inputField.inputContent"
                                            class="w-full border rounded border-gray-300 p-2 mb-1"
                                            type="text"
                                            value=""
                                        />

                                        <!-- textare -->
                                        <textarea
                                            v-if="
                                                inputField.inputType ===
                                                'textarea'
                                            "
                                            type="textarea"
                                            v-model="inputField.inputContent"
                                            class="w-full border rounded border-gray-300 p-2 h-32"
                                        ></textarea>

                                        <!-- textare_rtf -->
                                        <!-- tiny MCEへ置き換える -->
                                        <!-- <textarea
                                    v-if="
                                        inputField.inputType === 'textarea_rtf'
                                    "
                                    type="textarea"
                                    v-model="inputField.inputContent"
                                    class="w-full border rounded border-gray-300 p-2 h-32"
                                ></textarea> -->
                                        <Editor
                                            v-if="
                                                inputField.inputType ===
                                                'textarea_rtf'
                                            "
                                            v-model="inputField.inputContent"
                                            api-key="9vs0qfvaptabc555wnnfa7azwz22jq0pykxs1j8x8t1pcb0i"
                                            :init="{
                                                plugins:
                                                    'lists link code help wordcount',
                                                menubar: 'none',
                                            }"
                                        />

                                        <!-- checkbox -->
                                        <div
                                            v-if="
                                                inputField.inputType ===
                                                'checkbox'
                                            "
                                        >
                                            <div v-if="inputField.inputContent">
                                                <div
                                                    v-for="(
                                                        value, index
                                                    ) in inputField.checkContent"
                                                    :key="index"
                                                    class="flex flex-wrap items-center gap-1 mb-1"
                                                >
                                                    <input
                                                        v-bind:name="
                                                            'check-' +
                                                            inputField.id
                                                        "
                                                        type="checkbox"
                                                        v-bind:id="
                                                            inputField.id +
                                                            '-' +
                                                            index
                                                        "
                                                    />
                                                    <label
                                                        v-bind:for="
                                                            inputField.id +
                                                            '-' +
                                                            index
                                                        "
                                                        class="text-sm"
                                                        >{{ value }}</label
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <!-- radio -->
                                        <div
                                            v-if="
                                                inputField.inputType === 'radio'
                                            "
                                        >
                                            <div v-if="inputField.inputContent">
                                                <div
                                                    v-for="(
                                                        value, index
                                                    ) in inputField.radioContent"
                                                    :key="index"
                                                    class="flex flex-wrap items-center gap-1 mb-1"
                                                >
                                                    <input
                                                        v-bind:name="
                                                            'radio-' +
                                                            inputField.id
                                                        "
                                                        type="radio"
                                                        v-bind:id="
                                                            inputField.id +
                                                            '-' +
                                                            index
                                                        "
                                                    />
                                                    <label
                                                        v-bind:for="
                                                            inputField.id +
                                                            '-' +
                                                            index
                                                        "
                                                        class="text-sm"
                                                        >{{ value }}</label
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <!-- select -->
                                        <div
                                            v-if="
                                                inputField.inputType ===
                                                'select'
                                            "
                                        >
                                            <div v-if="inputField.inputContent">
                                                <select
                                                    v-bind:name="
                                                        'select-' +
                                                        inputField.id
                                                    "
                                                    class="w-auto border rounded border-gray-300 px-2 py-1 text-sm flex flex-wrap items-center gap-1 mb-1"
                                                >
                                                    <option
                                                        v-bind:for="
                                                            inputField.id +
                                                            '-' +
                                                            index
                                                        "
                                                        value="selecte"
                                                        class="text-sm"
                                                    >
                                                        選択してください
                                                    </option>
                                                    <template
                                                        v-for="(
                                                            value, index
                                                        ) in inputField.selectContent"
                                                        :key="index"
                                                    >
                                                        <option
                                                            v-bind:for="
                                                                inputField.id +
                                                                '-' +
                                                                index
                                                            "
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
                                        <hr
                                            v-if="inputField.inputType === 'hr'"
                                            class="mb-8 mt-4 border-gray-400"
                                        />
                                    </div>

                                    <!-- limit / code -->
                                    <div class="flex">
                                        <!-- limit -->
                                        <div
                                            v-if="
                                                inputField.inputType ===
                                                    'text' ||
                                                inputField.inputType ===
                                                    'textarea' ||
                                                inputField.inputType ===
                                                    'textarea_rtf'
                                            "
                                        >
                                            <p
                                                v-if="
                                                    !inputField.inputLimit == 0
                                                "
                                                class="text-xs text-gray-900"
                                            >
                                                {{
                                                    inputField.inputContent
                                                        .length
                                                }}
                                                /
                                                {{
                                                    inputField.inputLimit
                                                }}&nbsp;文字
                                            </p>
                                        </div>
                                        <!-- code -->
                                        <div
                                            v-if="
                                                !(inputField.inputType === 'hr')
                                            "
                                            class="flex justify-end text-xs text-gray-300 ml-auto"
                                        >
                                            <p
                                                v-text="inputField.inputCode"
                                            ></p>
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
                    class="w-80 p-4 border-l border-gray-300 break-all"
                    style="font-size: 9px"
                >
                    <p style="white-space: pre-wrap">
                        {{ inputFields }}
                    </p>
                </div>
            </div>
        </div>

        <!-- ボトム -->
        <div class="bottom-0 z-50 w-full border-t border-gray-300 bg-white">
            <div class="max-w-7xl mx-auto flex justify-end py-4 px-8">
                <form @submit.prevent="sendData">
                    <input
                        type="hidden"
                        name="inputFields"
                        v-model="inputFields"
                        placeholder="Enter name"
                    />
                    <input
                        type="hidden"
                        name="form_id"
                        :value="formAttribute.id"
                    />
                    <button type="submit">更新する</button>
                </form>
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
