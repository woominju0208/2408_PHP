import axios from "../../axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({

    }),
    mutations: {

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
                console.log(response);
                router.replace('/boards');
            })
            .catch(error => {
                console.log(error.response);
            }); 

        }

    },
    getters: {

    }
}