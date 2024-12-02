import axios from "axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setPage(state, page) {
            state.page = page;
        },
        setLastPageFlg(state, flg) {
            state.lastPageFlg = flg;
        },

    },
    actions: {
        // 게시글 획득
        getBoardListPagination(context) {
            // 디바운싱 처리 시작
            // 클릭으로 페이지 요청 한번 보냈을때 false로 변환(여러번 클릭 방지)
            // TODO: 디바운싱 처리 

            const url = '/api/boards?page=' + context.state.page;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'), 
                }
            }
            axios.get(url, config)
            .then(response => {
                // console.log('게시글 요청', response.data.boardList);
                context.commit('setBoardList', response.data.boardList.data);
                context.commit('setPage', response.data.boardList.current_page);
                // 더이상 불러올 데이터 없을시, 불필요한 요청 안보내기 위한 처리
                if(response.data.boardList.current_page >= response.data.boardList.last_page) {
                    // 마지막 페이지 일 경우 true 처리
                    context.commit('setLastPageFlg', true);
                }
            })
            .catch(error => {
                console.log(error);
            });
        },
    },
    getters: {

    }
}