import "./bootstrap";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import InputComponent from "./Components/InputComponent.vue";
import { createApp } from "vue";

const app = createApp({});
app.component("InputComponent", InputComponent);
app.mount("#app");
