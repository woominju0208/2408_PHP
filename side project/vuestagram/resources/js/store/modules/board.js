import axios from "../../axios";
// import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,
    }),
    mutations: {
        // 위에 state를 적고 mutations 도 쌍으로 적어준다.
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setPage(state, page) {
            state.page = page;
        },
    },
    actions: {
        /**
         * 게시글 획득
         * 
         * @param {*} context
         */
        getBoardListPagination(context) {
            const url = '/api/boards?page=' + context.getters['getNextPage'];
            // 로그인한 유저가 보드정보를 가져와야 하니 액세스 토큰을 가져옴
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response);
                context.commit('setBoardList', response.data.boardList.data);
                context.commit('setPage', response.data.boardList.current_page);
            })
            .catch(error => {
                console.log(error);
            });
        },
    },
 
    getters : {
        // state에 있는 값을 특정 연산을 통해서 값을 받아야 할 때 사용
        getNextPage(state) {
            return state.page + 1;
        },
    }
}