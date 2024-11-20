<template>
    <!-- app.js에 .use(router) 때문에 템플릿에서 바로 router 접속 가능 -->
    <div class="form-box">
        <h3 class="form-title">글 작성</h3>
        <img src="">
        <textarea name="content" placeholder="내용을 입력 해 주세요." maxlength="200"></textarea>
        <!-- accept="image/*" : 유저가 image 파일만 나옴 -->
        <input type="file" name="file" accept="image/*">
        <button class="btn btn-bg-black btn-submit">작성</button>
        <button @click="$router.back()" class="btn btn-submit">취소</button>
        <!-- $router.back() : 브라우저의 뒤로가기 기능 -->
    </div>
</template>

<script setup>

</script>

<style>
    
</style>