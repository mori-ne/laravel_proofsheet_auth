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

import { Jodit } from 'jodit';
import 'jodit/es5/jodit.min.css';

const editor = Jodit.make('#editor', {
    iframe: true,
    showXPathInStatusbar: false,
    inline: false,
    toolbarInlineForSelection: true,
    showPlaceholder: false,
    buttons: 'bold,italic,underline,ul,ol,fontsize,paragraph,superscript,subscript,brush,source,fullsize,preview,print',
});
const editor2 = Jodit.make('#editor2', {
    iframe: true,
    showXPathInStatusbar: false,
    inline: false,
    toolbarInlineForSelection: true,
    showPlaceholder: false,
    buttons: 'bold,italic,underline,ul,ol,fontsize,paragraph,superscript,subscript,brush,source,fullsize,preview,print',
});
