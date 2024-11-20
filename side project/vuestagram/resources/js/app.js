require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import AppComponent from '../views/components/AppComponent.vue';

createApp({
    components: {
        AppComponent,
    }
})
.use(router)
.mount('#app');
// mount('#app'): id가 app이라는곳에 올리겠다. > welcome.blade.php 안에 id있음