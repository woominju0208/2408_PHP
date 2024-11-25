require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import AppComponent from '../views/components/AppComponent.vue';
import store from './store/store';

createApp({
    components: {
        AppComponent,
    }
})
.use(store)
.use(router)
.mount('#app');
// mount('#app'): id가 app이라는곳에 올리겠다. > welcome.blade.php 안에 id있음