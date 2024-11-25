<template>
    <!-- Header -->
     <header>
        <div class="header-container">
            <div class="header-content">
                <div class="title">
                    <a href=""><h1>Vuestagram</h1></a>
                </div>
                <img src="/다운로드.jfif" class="img-logo">
                <div class="btn-group">
                    <div v-if="!$store.state.user.authFlg">
                        <router-link to="/login"><button class="btn btn-header btn-bg-black">로그인</button></router-link>
                        <router-link to="/registration"><button class="btn btn-header btn-bg-white">회원가입</button></router-link>
                    </div>
                    <div v-else>
                        <button @click="$store.dispatch('user/logout')" class="btn btn-header btn-bg-black">로그아웃</button>
                        <!-- 프론트에서 로그아웃 하면 authFlg 를 false로 바꾸고 local storage 를 초기화 -->
                    </div>
                </div>
            </div>
        </div>
     </header>

    <!-- Main -->
     <main>
        <!-- 로그인 시 상단 정보 뜨는게 제어 -->
        <UserInfoComponent v-if="$store.state.user.authFlg" />
        <div class="container">
            <!-- vue Router : 뷰에서 패스를 통해 특정 컴포넌트를 띄어줘야 함 -->
            <router-view></router-view>
        </div>
     </main>

    <!-- Footer -->
     <footer>
        <p>ⓒ 2024. ManduKing All rights reserved.</p>
     </footer>
</template>
<script setup>
import UserInfoComponent from './user/UserInfoComponent.vue';

</script>
<style>
/* 공통 css 불러오기 */
/* css문법은 @import */
/* css를 불러오면 전역으로 되서 scoped가 적용되지 않는다. */
@import url('../../css/common.css');
</style>