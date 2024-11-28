require('./bootstrap');

import { createApp } from 'vue';
import AppComponent from '../views/component/AppComponent.vue';
import router from './router';

createApp({
    components: {
        AppComponent,
    }
})
.mount('#app');