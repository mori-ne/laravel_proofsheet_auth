<script setup>
import { ref } from 'vue';
import axios from 'axios';

// 状態管理
const zipcode = ref('');
const address = ref(null);

// メソッド
const getAddress = async () => {
    try {
        const response = await axios.get(`/api/address/${zipcode.value}`);
        const data = response.data.results[0];
        address.value = `${data.address1} ${data.address2} ${data.address3}`;
    } catch (error) {
        console.error('住所の取得に失敗しました', error);
        address.value = '住所を取得できませんでした';
    }
};
</script>

<template>
    <div>
        <input type="text" v-model="zipcode" placeholder="郵便番号を入力" />
        <button @click="getAddress">住所を取得</button>

        <div v-if="address">
            <p>住所: {{ address }}</p>
        </div>
    </div>
</template>
