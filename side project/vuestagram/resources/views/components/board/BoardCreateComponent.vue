<template>
    <!-- app.js에 .use(router) 때문에 템플릿에서 바로 router 접속 가능 -->
    <div class="form-box">
        <h3 class="form-title">글 작성</h3>
        <img :src="preview">
        <textarea v-model="boardInfo.content" name="content" placeholder="내용을 입력 해 주세요." maxlength="200"></textarea>
        <!-- accept="image/*" : 유저가 image 파일만 나옴 -->
        <input @change="setfIle" type="file" name="file" accept="image/*">
        <!-- store에 actions메소드 부를때는 dispatch() -->
        <button @click="$store.dispatch('board/storeBoard', boardInfo)" class="btn btn-bg-black btn-submit">작성</button>
        <button @click="$router.push('/boards')" class="btn btn-submit">취소</button>
        <!-- $router.back() : 브라우저의 뒤로가기 기능 -->
         <!-- $router.push('/boards') : /boards로 이동 -->
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';

const boardInfo = reactive({    // content,file 에 양방향객체 사용 => reactive
    content: ''
    ,file: null
});
// file preview 생성 (문자열 출력) => ref ref의값은 .value로 붙어야함
const preview = ref('');

const setfIle = (e) => {
    boardInfo.file = e.target.files[0];
    preview.value = URL.createObjectURL(boardInfo.file);
}

</script>

<style>
    
</style>