import axios from "../../axios";
import router from "../../router";


export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,
        boardDetail: null,  // 빈객체{}로 보내면 boardDetail.user.name에서 오류 그래서 null로 보냄
        controllFlg: true,  // 디바운싱 플래그
        lastPageFlg: false,
    }),
    mutations: {
        // 위에 state를 적고 mutations 도 쌍으로 적어준다.
        // concat : 기존에 있는 배열에 새로운 배열을 합치고 반환한다.
        setBoardList(state, boardList) {
            state.boardList = state.boardList.concat(boardList);
        },
        setPage(state, page) {
            state.page = page;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },
        setBoardListUnshift(state, board) {
            state.boardList.unshift(board);
        },
        setControllFlg(state, flg){
            state.controllFlg = flg;
        },
        setLastPageFlg(state, flg) {
            state.lastPageFlg = flg;
        },
    },
    actions: {
        // !action 메소드에 axios는 한세트!
        /**
         * 게시글 획득
         * 
         * @param {*} context
         */
        // 관습적으로 앞에 get은 getter쪽만 붙이는게 맞다.
        boardListPagination(context) {
            context. dispatch('user/chkTokenAndContinueProcess',
                () => {
                    // 디바운싱 처리 시작
                    if(context.state.controllFlg && !context.state.lastPageFlg) {
                        context.commit('setControllFlg', false);    
        
                        const url = '/api/boards?page=' + context.getters['getNextPage'];
                        // 로그인한 유저가 보드정보를 가져와야 하니 액세스 토큰을 가져옴
                        const config = {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                            }
                        }
        
                        axios.get(url, config)
                        .then(response => {
                            console.log('게시글 요청',response.data.boardList);
                            context.commit('setBoardList', response.data.boardList.data);
                            context.commit('setPage', response.data.boardList.current_page);
                            // 더이상 불러올 데이터 없을시, 불필요한 요청 안보내기 위한 처리 
                            if(response.data.boardList.current_page >= response.data.boardList.last_page) {
                                // 마지막 페이지 일 경우 플래그 true
                                context.commit('setLastPageFlg', true);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        })
                        .finally(() => {
                            context.commit('setControllFlg', true); // flg true처리는 axios 내부에 적용해야한다.(비동기 처리)
                        });
                    }
                }, 
                {root: true});

        },
        /**
         * 게시글 상세 정보 획득
         * 
         * @param {*} context
         * @param {int} id
         */
        // 다른 모듈 사용법(액션메소드기 때메 dispatch) (사용할 모듈, 실행할 콜백함수, root지정)
        showBoard(context, id) {
            context.dispatch('user/chkTokenAndContinueProcess',
                 () => {
                     const url = '/api/boards/' + id;     // id 는 세그먼트 파라미터
                     const config = {
                         headers: {
                             'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                         }
                     }
         
                     axios.get(url, config)
                     .then(response => {
                         // console.log(response);
                         context.commit('board/setBoardDetail', response.data.board, {root: true});
                     })
                     .catch(error => {
                         console.error(error);
                     });
                 }
                 , {root: true});

        },

        /**
         * 게시글 작성
         */
        storeBoard(context, data) {
            context.dispatch('user/chkTokenAndContinueProcess',
                () => {
                    // 디바운싱 조건
                    if(context.state.controllFlg) {
                        // 처음 false로 설정후 데이터 생성 실행 => 데이터가 하나만 들어가고 연결까지 비활성화
                        context.commit('setControllFlg', false);
        
                        const url = '/api/boards';
                        const config = {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                            }
                        };
                        // form data 생성
                        const formData = new FormData();
                        // 전달 데이터 셋팅
                        formData.append('content', data.content);
                        formData.append('file', data.file);
            
            
                        axios.post(url, formData, config)
                        .then(response => {
                            // unshift : 배열 제일 앞으로 보냄
                            context.commit('setBoardListUnshift', response.data.board);
        
                            // 다른 모듈 접근(user.js 모듈 접근)
                            context.commit('user/setUserInfoBoardsCount', null, {root: true});
                            // 2번째 파라미터는 보내줄 데이터로 보내줄게 없어서 null로 설정
                            // 3번째 파라미터로 root: true로 하면 무조건 store 최상위로 붙는다. state,mutations붙을수 있음(dispatch, commit)
            
                            router.replace('/boards');
                        })
                        .catch(error => {
                            console.error(error);
                        })
                        .finally(() => {
                            // 실행 완료후 true로 전환
                            context.commit('setControllFlg', true);    
                        });
                    }
                }
                ,{root: true});
        },
    },
 
    getters : {
        // state에 있는 값을 특정 연산을 통해서 값을 받아야 할 때 사용
        getNextPage(state) {
            return state.page + 1;
        },
    }
}
