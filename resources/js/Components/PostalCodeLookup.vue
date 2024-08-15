<script setup>
import { ref } from 'vue';
import axios from 'axios';

// 状態管理
const zipcode = ref('');
const address = ref(null);

const address1 = ref(null);
const address2 = ref(null);

// メソッド
const getAddress = async () => {
    console.log(zipcode.value);

    try {
        const path = __PROJECT_ROOT__;
        const response = await axios.get(path + `/api/address/${zipcode.value}`);
        console.log(response);

        const data = response.data.results[0];
        console.log(data);

        address1.value = `${data.address1}`;
        address2.value = `${data.address2}${data.address3}`;
        address.value = null; // 成功したら、エラーメッセージをクリア
    } catch (error) {
        console.error('住所の取得に失敗しました', error);
        address.value = '住所を取得できませんでした';
    }
};
</script>

<template>
    <div class="mb-2">
        <label class="mb-2 block text-sm font-medium text-gray-700">所属先住所</label>
        <div class="flex flex-row gap-2">
            <input
                type="text"
                name="zipcode"
                class="rounded border border-gray-300 py-1.5"
                v-model="zipcode"
                placeholder="郵便番号を入力"
            />
            <input
                type="button"
                class="rounded bg-black px-3 py-1.5 text-sm text-white"
                v-on:click="getAddress"
                value="住所を取得"
            />
        </div>
    </div>

    <div class="flex flex-row gap-2">
        <div class="mb-2 w-1/2">
            <label class="mb-2 block text-sm font-medium text-gray-700">都道府県</label>
            <input
                name="address_country"
                class="w-full rounded border-0 border-gray-300 bg-gray-100 py-2 text-gray-500"
                type="text"
                :value="address1"
                readonly
            />
        </div>
        <div class="mb-2 w-1/2">
            <label class="mb-2 block text-sm font-medium text-gray-700">市町村</label>
            <input
                name="address_city"
                class="w-full rounded border-0 border-gray-300 bg-gray-100 py-2 text-gray-500"
                type="text"
                :value="address2"
            />
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">番地（部屋番号等）</label>
        <input name="address_etc" class="w-full rounded border border-gray-300 py-1.5" type="text" />
    </div>
    <p v-if="address" class="text-sm text-red-500">※住所を取得できませんでした</p>
</template>
