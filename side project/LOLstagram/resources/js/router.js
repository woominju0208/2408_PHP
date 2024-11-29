import { createWebHistory, createRouter } from "vue-router";
import LoginComponent from '../views/component/auth/LoginComponent.vue';
import BoardListComponent from '../views/component/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/component/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/component/user/UserRegistrationComponent.vue';

const routes = [
    {
        // / 일시 로그인 페이지
        path: '/',
        redirect: '/login',
    },
    {
        // 로그인 페이지
        path: '/login',
        component: LoginComponent,
    },
    {
        // 게시판 페이지
        path: '/boards',
        component: BoardListComponent,
    },
    {
        // 게시글 작성 페이지
        path: '/boards/create',
        component: BoardCreateComponent,
    },
    {
        // 회원가입 작성 페이지
        path: '/registration',
        component: UserRegistrationComponent,
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;