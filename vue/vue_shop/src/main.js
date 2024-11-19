import { createApp } from 'vue'
import App from './App.vue'
import store from './store/store.js'    // Vuex 저장소 import

createApp(App)
.use(store)     // Vuex 저장소 사용(위에서 import한 store.js)
.mount('#app')
