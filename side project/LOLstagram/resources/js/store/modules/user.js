import axios from "../../axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo:  localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
    }),
    mutations: {
        setAuthFlg(state, flg) {
            state.authFlg = flg
        },
        setUserInfo(state, flg) {
            state.userInfo = flg
        },
        setUserInfoBoardsCount(state) {
            state.userInfo.boards_count++;
            localStorage.setItem('userInfo', JSON.stringify(state.userInfo));
        },
    },
    actions: {
        // 로그인 처리
        login(context, userInfo){
            const url = '/api/login';
            const data = JSON.stringify(userInfo);
            // const config = {
            //     headers: {
            //         'Content-Type' : 'application/json',
            //     }
            // }
            
            axios.post(url, data)
            .then(response => {
                // 토큰저장(local storage)
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);

                // 로그인후 보드페이지로 이동
                router.replace('/boards');
            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;
                if(error.response.status === 422) {
                    // 유효성 체크 에러
                    if(errorData.data.account) {
                        errorMsgList.push(errorData.data.account[0]);
                    }
                    if(errorData.data.password) {
                        errorMsgList.push(errorData.data.password[0]);
                    }
                } else if(error.response.status === 401) {
                    // 비밀번호 오류
                    errorMsgList.push(errorData.msg);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }
                alert(errorMsgList.join('\n'));
            }); 
        },

        // 로그아웃 처리
        logout(context) {
            const url = '/api/logout';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.post(url, null, config)
            .then(response => {
                alert('로그아웃 완료');
            })
            .catch(error => {
                alert('예기치 못한 오류로 로그아웃');
            })
            .finally(() => {
                localStorage.clear();

                // commit 초기화
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
                // 로그아웃후 페이지로 이동
                router.replace('/login');
            });
        },

        // registration 처리
        registration(context, userInfo) {
            const url = '/api/registration';
            const config = {
                headers: {
                    'Content-Type' : 'multipart/form-data',
                }
            };

            // form data  생성
            const formData = new FormData();
            formData.append('account', userInfo.account);
            formData.append('password', userInfo.password);
            formData.append('password_chk', userInfo.password_chk);
            formData.append('name', userInfo.name);
            formData.append('gender', userInfo.gender);
            formData.append('profile', userInfo.profile);

            // axios 처리
            axios.post(url,formData, config)
            .then(response => {
                alert('회원가입 성공!\n가입하신 계정으로 로그인 해 주세요.');
                router.replace('/login');
            })
            .catch(error => {
                alert('회원가입 실패');
            });



        }

    },
    getters: {

    }
}