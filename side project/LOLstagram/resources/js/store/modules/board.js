import axios from "axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,
        boardDetail: null,
        controllFlg: true,
        lastPageFlg: false,
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
        setControllFlg(state, flg) {
            state.controllFlg = flg;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },
        setBoardListUnshift(state, board) {
            state.boardList.unshift(board);
        },


    },
    actions: {
        // 게시글 획득
        boardListPagination(context) {
            // 디바운싱 처리 시작
            // 클릭으로 페이지 요청 한번 보냈을때 false로 변환(여러번 클릭 방지) 
            if(context.state.controllFlg && !context.state.lastPageFlg) {
                context.commit('setControllFlg', false);
            }

            const url = '/api/boards?page=' + context.getters['getNextPage'];
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
            })
            .finally(() => {
                context.commit('setControllFlg', true);
            });
        },
        showBoard(context, id) {
            const url = '/api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response);
                // root:true 가 왜들어가지...
                context.commit('board/setBoardDetail', response.data.board, {root: true});
            })
            .catch(error => {
                console.log(error);
            }); 
        },
        storeBoard(context, data) {
            const url = '/api/boards';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            // form data  생성
            const formData = new FormData();
            formData.append('content', data.content);
            formData.append('file', data.file);

            axios.post(url, formData, config)
            .then(response => {
                // 글작성 후 최상단 위치
                context.commit('setBoardListUnshift', response.data.board);
                // 다른 모듈 접근
                context.commit('user/setUserInfoBoardsCount', null, {root: true});

                router.replace('/boards');
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                context.commit('setControllFlg', true);
            });
        }
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    }
}