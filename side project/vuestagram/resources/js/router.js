import { createWebHistory, createRouter } from 'vue-router';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
import { useStore } from 'vuex';
import NotFoundComponent from '../views/components/NotFoundComponent.vue';

// to : 이동할 경로의 정보
// from : 라우트 오기전에 경로의 정보
// next : 라우트 처리 다 끝나고 후속 처리할 객체 정보
const chkAuth = (to, from, next) => {
    const store = useStore();
    const authFlg = store.state.user.authFlg;   // 로그인 여부 플래그
    // 셋다 만족하면 true, 하나라도 만족안하면 false
    const noAuthPassFlg = (to.path === '/' || to.path === '/login' || to.path === '/registration'); // 비로그인시 접근 가능 페이지 플래그

    if(authFlg && noAuthPassFlg) {
        // 인증 된 유저가 비인증으로 이동할 수 있는 페이지에 접근할 경우 board로 이동 
        next('/boards');
    } else if(!authFlg && !noAuthPassFlg) {
        // 인증이 안된 유저가 비인증으로 접근할 수 없는 페이지에 접근할 경우 login으로 이동
        next('/login');
    } else {
        // 그외는 접근 허용
        next(); // next()에 아무것도 안적으면 원래가려던 경로로 이동
    }
}

const routes = [
    // router : url path 작성시 페이지 컴포넌트 따라 이동
    // 뷰 라우터지 서버로 요청하는 라라벨 라우터가 아님
    // router파일은 router.js 하나고 const routes 안에 페이지(패스랑 컴포넌트)를 늘려가면된다.(위에 import도 필수!)
    {
        // / 일시 로그인 페이지
        path: '/',
        redirect: '/login',
        beforeEnter: chkAuth,
    },
    {
        // /login 일시 로그인 페이지
        path: '/login',
        component: LoginComponent,
        beforeEnter: chkAuth,
    },
    {
        // /boards 일시 보드 페이지
        path: '/boards',
        component: BoardListComponent,
        beforeEnter: chkAuth,
    },
    {
        // /board/create 일시 보드 작성 페이지
        path: '/boards/create',
        component: BoardCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        // /registration 일시 회원가입 페이지
        path: '/registration',
        component: UserRegistrationComponent,
        beforeEnter: chkAuth,
    },
    {
        // 경로이외의 url은 404 not found
        // 주의 ! 가장 마지막에 적어야함
        path: '/:catchAll(.*)',
        component: NotFoundComponent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;