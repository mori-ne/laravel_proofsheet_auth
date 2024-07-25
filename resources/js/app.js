import "./bootstrap";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import { createApp } from "vue";
import InputComponent from "./Components/InputComponent.vue";

createApp(InputComponent).mount("#app");
