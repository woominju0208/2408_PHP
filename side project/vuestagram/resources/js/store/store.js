// modules를 한번에 모아두는 메인
import { createStore } from 'vuex';
import user from './modules/user'; 
import board from './modules/board';

export default createStore({
    modules: {
        user,
        board,
    }
});