<template>
    <div class="form-box">
        <p class="form-title">로그인</p>
        <!-- form 태그 없이 axios를 통해 전달 -->
         <!-- v-model 로 UserInfo 에 실시간으로 데이터 담김 -->
        <input v-model="UserInfo.account" type="text" name="account" placeholder="아이디">
        <input v-model="UserInfo.password" type="password" name="password" placeholder="비밀번호">
        <button @click="$store.dispatch('user/login', UserInfo)" class="btn btn-submit btn-bg-black">로그인</button>
        <!-- 템플릿에서는 $store를 app.js 안에 사용 선언하고 사용가능 -->
        <!-- 여러군데 사용시에는 use store 해줘야함 -->
        <!-- $store.dispatch('user/login', UserInfo) 로 해당 액션메소드 실행 user/login로 user파일에 login액션메소드을 사용중 -->
    </div>
</template>
<script setup>
import { reactive } from 'vue';

    const UserInfo = reactive({
        account: '',
        password: '',
    });
</script>
<style>
    
</style>