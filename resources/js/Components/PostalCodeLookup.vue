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
        const path = 'http://localhost:8888/laravel_proofsheet_auth/public/';
        const response = await axios.get(
            `http://localhost:8888/laravel_proofsheet_auth/public` + `/api/address/${zipcode.value}`,
        );
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
    <label class="mb-2 block text-sm font-medium text-gray-700"
        >所属先住所<span class="pl-1 text-red-500">*</span></label
    >

    <div class="mb-2">
        <label class="mb-1 block text-xs font-medium text-gray-400">郵便番号</label>
        <div class="flex flex-row gap-2">
            <input
                class="w-1/4 rounded border border-gray-300"
                type="text"
                v-model="zipcode"
                placeholder="郵便番号を入力"
            />
            <button class="rounded border border-gray-300 px-3 py-2" @click="getAddress">住所を取得</button>
        </div>
    </div>

    <div class="mb-8">
        <div class="flex flex-row gap-2">
            <div class="mb-2 w-1/4">
                <label class="mb-1 block text-xs font-medium text-gray-400">都道府県</label>
                <input class="w-full rounded border border-gray-300" type="text" :value="address1" />
            </div>
            <div class="mb-2 w-3/4">
                <label class="mb-1 block text-xs font-medium text-gray-400">市町村</label>
                <input
                    class="w-full rounded border border-gray-300"
                    name="affiliate_city"
                    type="text"
                    :value="address2"
                />
            </div>
        </div>
        <div class="mb-2">
            <label class="mb-1 block text-xs font-medium text-gray-400">番地、その他</label>
            <input class="w-full rounded border border-gray-300" name="affiliate_etc" type="text" />
        </div>
        <p v-if="address" class="text-sm text-red-500">※住所を取得できませんでした</p>
    </div>
</template>
