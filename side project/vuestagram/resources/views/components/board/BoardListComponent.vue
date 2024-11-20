<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <div @click="openModal" class="item">
            <img src="/img/cat10.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat9.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat8.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat7.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat6.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat5.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat4.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat3.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat2.jfif" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/cat1.webp" alt="">
        </div>
    </div>

    <!-- 상세 모달 -->
     <div v-show="modalFlg" class="board-detail-box">
        <div class="item">
            <img src="/img/cat6.jpg">
            <hr>
            <p>야옹야옹내용내용</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : 김애옹</span>
                <button @click="closeModal">닫기</button>
            </div>
        </div>
     </div>
</template>
<script setup>
import { ref } from 'vue';

// ------------------------
// 모달관련
const modalFlg = ref(false);
const openModal = () => {
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}
// ------------------------

</script>
<style>
    @import url(../../../css/boardList.css);
</style>