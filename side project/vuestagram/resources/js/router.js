import { createWebHistory, createRouter } from 'vue-router';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';

const routes = [
    // router : url path 작성시 페이지 컴포넌트 따라 이동
    // 뷰 라우터지 서버로 요청하는 라라벨 라우터가 아님
    // router파일은 router.js 하나고 const routes 안에 페이지(패스랑 컴포넌트)를 늘려가면된다.(위에 import도 필수!)
    {
        // / 일시 로그인 페이지
        path: '/',
        redirect: '/login',
    },
    {
        // /login 일시 로그인 페이지
        path: '/login',
        component: LoginComponent,
    },
    {
        // /board 일시 보드 페이지
        path: '/board',
        component: BoardListComponent,
    },
    {
        // /board/create 일시 보드 작성 페이지
        path: '/board/create',
        component: BoardCreateComponent,
    },
    {
        // /registration 일시 회원가입 페이지
        path: '/registration',
        component: UserRegistrationComponent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;