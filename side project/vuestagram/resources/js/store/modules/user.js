// import axios from "axios";
import axios from "../../axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        // local storage에 액세스 토큰이있으면 가져오고 없으면 빈 문자열
        // 실제론 토큰을 화면에 출력하지 않으니 state에 토큰을 저장하지 않음/ 있냐 없냐 유무(true or false)를 저장
        // accessToken: localStorage.getItem('accessToken') ? localStorage.getItem('accessToken') : '',
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {}, 
    }),
    mutations: {
        // setAccessToken(state, accessToken) {
        //     state.accessToken = accessToken;
        //     localStorage.setItem('accessToken', accessToken);   // localStorage 에 액세스 토큰 저장
        // },
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
    },
    actions: {
        // 비동기처리는 actions에서(서버와 관련된 ajax , axios)
        // --------------------------
        // 인증관련
        // --------------------------
        /**
         * 로그인 처리
         * 
         * @param {*} context
         * @param {*} userInfo
         */
        // actions의 첫번째 파라미터는 무조건 context , context는 store 전체를 말함
        login(context, userInfo) {
            const url = '/api/login';
            const data = JSON.stringify(userInfo);  // 객체 userInfo를 json형태로 시리얼라이징, http 통신으로 보낼수있는건 문자열 그래서 객체형식으로 보낼수 없음
            // const config = {
            //     headers: {
            //         'Content-type': 'application/json'
            //     }   // 받는 타입이 json 형태인걸 인식 /기존 http method의 post 는 form 형식으로 적용
            // }
            
            // axios.post(url, data, config)
            axios.post(url, data)
            .then(response => {
                // console.log(response);
                // 토큰 저장(local storage)
                // context.commit('setAccessToken', response.data.accessToken);
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);

                // 로그인 후 보드 리스트로 이동
                router.replace('/boards');

            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;

                // console.log(error.response);
                if(error.response.status === 422) {
                    // 유효성 체크 에러
                    if(errorData.data.account) {
                        errorMsgList.push(errorData.data.account[0]);
                    }
                    if(errorData.data.password) {
                        errorMsgList.push(errorData.data.password[0]);
                    }
                    // 비밀번호 오류 에러
                } else if (error.response.status === 401) {
                    // errorMsgList.push(errorData.msg);
                    // 뷰(프론트) 에서 에러메세지를 무조건 라라벨(백)쪽 메세지를 사용하지 않아도 된다.
                    errorMsgList.push('비밀번호가 일치하지 않습니다.');
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }

                alert(errorMsgList.join('\n'));
                // join : 배열을 문자열로 출력
            });
        },
        /**
         * 로그아웃 처리
         * 
         * @param {*} context
         */
        logout(context) {
            // TODO : 백엔드 처리 추가
            const url = '/api/logout';
            // 로그아웃시 백에 토큰을 보내야함
            // 토큰을 파라미터에 담는게 아니라 헤더에 담음
            const config = {
                headers: {
                    // 'Authorization': 'Bearer ' 형태 와 로컬스토리지에 액세스 토큰을 보내줌
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            // 백에 로그아웃 처리 완료후 프론트 처리
            axios.post(url, null, config)
            .then(response => {
                alert('로그아웃 완료');
            })
            .catch(error => {
                alert('문제가 발생하여 로그아웃 처리');
            })
            .finally(() => {    // finally 는 성공이든 실패든 무조건 로컬스토리지 초기화하고 로그아웃후 로그인 페이지로 이동
                localStorage.clear();   // clear: 로컬스토리지 초기화
    
                // state 초기화
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
    
                router.replace('/login');
            });

        },

    },
    getters : {

    }
}