import { createWebHistory, createRouter } from "vue-router";
import LoginComponent from '../views/component/auth/LoginComponent.vue';

const routes = [
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
        // /boards 일시 게시판 페이지
        path: '/boards',
        component: LoginComponent,
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;