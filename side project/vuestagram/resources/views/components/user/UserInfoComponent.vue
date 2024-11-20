<template>
    <div class="user-info-box">
        <img src="/profile/profile1.png">
        <div class="user-info-content">
            <h2>유저아이디</h2>
            <h3>작성글 수 : 999</h3>
        </div>
        <!-- router 로 이동처리 => 뷰 라우터 -->
        <router-link to="/board/create"><button class="btn btn-submit">글작성</button></router-link>
    </div>
</template>

<script setup>

</script>

<style>
@import url(../../../css/userInfo.css);    
</style>