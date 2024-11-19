// store.js 의 기본 형태
import { createStore } from "vuex";
import board from "./modules/board.js";
import test from "./modules/test.js";

// export 는 createStore가 새로운 객체를 생성후 내보낸다. > main.js에서 store 요청중
export default createStore({
    modules: {
        board,  // 위에 board.js import후 modules안에 board 입력
        test,
    },
});