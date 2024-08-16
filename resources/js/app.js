import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue';
import InputComponent from './Components/InputComponent.vue';
import PostalCodeLookup from './Components/PostalCodeLookup.vue';

const app = createApp({});
app.component('InputComponent', InputComponent);
app.component('PostalCodeLookup', PostalCodeLookup); // PostalCodeLookup コンポーネントを登録
app.mount('#app');
