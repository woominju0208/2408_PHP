import { createWebHistory, createRouter } from "vue-router";
import LoginComponent from '../views/component/auth/LoginComponent.vue';
import BoardListComponent from '../views/component/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/component/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/component/user/UserRegistrationComponent.vue';
import { useStore } from 'vuex';
import NotFoundComponent from "../views/component/NotFoundComponent.vue";

// useStore : vuex 내장함수
const chkAuth = (to, from, next) => {
    const store = useStore();
    // 로그인 여부 확인
    const authFlg = store.state.user.authFlg;
    // 비로그인시 접근 가능
    const noAuthPassFlg = (to.path === '/' || to.path === '/login' || to.path === '/registration');

    if(authFlg && noAuthPassFlg) {
        // 인증된 유저가 비인증 페이지로 이동할려 할때 보드페이지로 이동
        next('/boards');
    } else if(!authFlg && !noAuthPassFlg) {
        // 비인증된 유저가 인증 페이지로 이동할려 할때 로그인페이지로 이동
        next('/login');
    } else {
        // 그외에는 접근허용
        next();
    }
}

const routes = [
    {
        // / 일시 로그인 페이지
        path: '/',
        redirect: '/login',
        beforeEnter: chkAuth,
    },
    {
        // 로그인 페이지
        path: '/login',
        component: LoginComponent,
        beforeEnter: chkAuth,

    },
    {
        // 게시판 페이지
        path: '/boards',
        component: BoardListComponent,
        beforeEnter: chkAuth,

    },
    {
        // 게시글 작성 페이지
        path: '/boards/create',
        component: BoardCreateComponent,
        beforeEnter: chkAuth,

    },
    {
        // 회원가입 작성 페이지
        path: '/registration',
        component: UserRegistrationComponent,
        beforeEnter: chkAuth,

    },
    {
        path:'/:catchAll(.*)',
        component: NotFoundComponent,
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;