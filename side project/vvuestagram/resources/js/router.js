import { createWebHistory, createRouter } from 'vue-router';
import LoginComponent from "../views/component/auth/LoginComponent.vue";
import BoardListComponent from '../views/component/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/component/board/BoardCreateComponent.vue';
import UserResistrationComponent from '../views/component/user/UserResistrationComponent.vue';

const routes = [
    {
        path: '/',
        redirect: '/login',
    },
    {
        path: '/login',
        component: LoginComponent,
    },
    {
        path: '/board',
        component: BoardListComponent,
    },
    {
        path: '/board/create',
        component: BoardCreateComponent,
    },
    {
        path: '/registration',
        component: UserResistrationComponent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;