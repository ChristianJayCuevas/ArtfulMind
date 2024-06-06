import './bootstrap';
import { createApp } from 'vue';
import draw from './components/draw.vue';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

createApp({})
  .component('draw', draw)
  .mount('#app')