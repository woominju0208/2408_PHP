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
        destroyBoard: null,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = state.boardList.concat(boardList);
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
        boardListPagination(context, scrollFlg) {
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
                // 초기게시글 데이터 셋
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
        // 게시글 상세
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
                // root:true : root를 true 로 줌으로써 store로 접근해 board.js말고 user.js도 접근할수 있다.
                context.commit('board/setBoardDetail', response.data.board, {root: true});
            })
            .catch(error => {
                console.log(error);
            }); 
        },
        // 게시글 작성
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

            // axios 처리
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
                alert('글작성 실패');
            })
            .finally(() => {
                context.commit('setControllFlg', true);
            });
        },

        // 보드 삭제 처리
        destroyBoard(context, id) {
            console.log(id);
            const url = '/api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    // 'Authorization': 'Bearer ' ,
                }
            }

            axios.delete(url, config)
            .then(response => {
                // console.log(JSON.stringify(response));
                alert('삭제 완료');
                window.location.reload();
            })
            .catch(error => {
                console.log(error);
            })
        },
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    }
}