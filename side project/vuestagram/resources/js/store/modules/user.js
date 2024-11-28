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
        setUserInfoBoardsCount(state) {
            state.userInfo.boards_count++;
            localStorage.setItem('userInfo', JSON.stringify(state.userInfo));
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
            context.dispatch('user/chkTokenAndContinueProcess',
                () => {
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
                {root: true});
        },

        /**
         * 회원가입 처리
         * 
         * @param {*} context
         * @param {*} userInfo
         */
        registration(context, userInfo) {
            const url = '/api/registration';
            const config = {
                // content-type을 json에서 multipart/form-data 로 수정 (이미지 파일 때문)
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };

            // form data 셋팅
            const formData = new FormData();
            // 전달 데이터 셋팅
            formData.append('account', userInfo.account);
            formData.append('password', userInfo.password);
            formData.append('password_chk', userInfo.password_chk);
            formData.append('name', userInfo.name);
            formData.append('gender', userInfo.gender);
            formData.append('profile', userInfo.profile);

            // 프론트 서버 전달
            axios.post(url, formData, config)
            .then(response => {
                alert('회원가입 성공\n가입하신 계정으로 로그인 해 주세요.');
                // 회원가입 완료후 로그인 페이지로 이동
                // router.replace(), router.push() 가 페이지를 이동시키는 메소드기 때문에 return 을 적을 필요 x
                router.replace('login');
            })
            .catch(error => {
                alert('회원가입 실패');
            });
        },

        /**
         * 토큰 만료 체크후 처리 속행
         * 
         * @param {*} context
         * @param {function} callbackProcess
         */
        chkTokenAndContinueProcess(context, callbackProcess) {
            // payload 획득
            // 문자열에 스플릿 메소드 : . 기준으로 나눠줌 [1] 은 앞에 1번방
            const payload = localStorage.getItem('accessToken').split('.')[1];
            const base64 = payload.replace(/-/g, '+').replace(/_/g, '/');      // /-/g, /_/g : regex 정규식 -,_를 +,/로 변환
            // 정규식으로 쓰는 이유는 같은 문자열로 하면 처음 하나만 변환됨 그래서 정규식에 g 글로벌로 하면 전체가 변환된다.
            // -,_ 는 경우에 따라 나올수 있기 때문에 +,/로 변환작업 작성 (사이트엔 나오지 않음)
            // 하지만 0.001% 라도 있으면 대응하는 코드를 적어줘야 해용
            // base64 decode 처리 (base64 형태를 json으로)
            const objPayload = JSON.parse(window.atob(base64));

            // 현재시간 구하기
            const now = new Date();

            // now.getTime() 밀리초, exp 시간은 초단위기 때문에 * 1000
            // 현재시간보다 토큰 유효시간이 작으면 만료
            // console.log(objPayload.exp * 1000 <= now.getTime());

            if((objPayload.exp * 1000) > now.getTime()) {
                // 토큰 유효    
                console.log('토큰 유효');
                callbackProcess();
            } else {
                // 토큰 만료
                console.log('토큰 만료');
                // 토큰 새로 발급
                context.dispatch('reissueAccessToken', callbackProcess);
            }
        },

        /**
         * 토큰 재발급 처리
         * 
         * @param {*} context
         * @param {callback} callbackProcess
         */
        reissueAccessToken(context, callbackProcess) {
            const url = '/api/reissue';
            const config = {
                headers: {
                    // 액세스 토큰을 재발급 받기위한 리프래시 토큰 적용
                    // 'Authorization': 'Bearer ' 하나도 오타안나게 하기!!!!!!!!!!
                    'Authorization': 'Bearer ' + localStorage.getItem('refreshToken')
                }
            };

            axios.post(url, null, config)   // 가져오는 데이터가 없어서 null
            .then(response => {
                // 토큰 셋팅
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                
                // 후속 처리 진행(콜백 함수)
                callbackProcess();
            })
            .catch(error => {
                console.error(error);
            });
        }
        // 토큰 만료시 토큰만료(chkTokenAndContinueProcess)가 뜨고 토큰 재발급처리(reissueAccessToken)를 해서 서버로 부터 토큰을 받고 유저가 실행할려던 콜백함수(callbackProcess) 그이후 처리를 진행한다.
        // 제한시간이 있는 금융권 사이트는 액세스 토큰이 끝나면 토큰을 삭제처리하고 로그인페이지로 이동한다.

    },
    getters : {

    }
}