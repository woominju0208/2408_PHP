<template>
    <div class="board-list-box">
        <div @click="openModal" class="item">
            <img src="/img/skin1.jpg">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin2.jpg">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin3.webp">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin4.webp">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin5.jpg">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin6.webp">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin7.webp">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/skin8.jfif">
        </div>
    </div>
    <div v-show="modalFlg" class="board-detail-box">
        <div class="item">
            <img src="/img/skin1.jpg">
            <hr>
            <p>내용내용</p>
            <hr>
            <div class="etc-box">
                <span>작성자</span>
                <button @click="closeModal">닫기</button>
            </div>
        </div>
    </div>
</template>
<script setup>

import { ref } from 'vue';
    // modal 숨기기
    const modalFlg = ref(false);
    // modal 열기
    const openModal = () => {
        modalFlg.value = true;
    };
    // modal 닫기
    const closeModal = () => {
        modalFlg.value = false;
    };


</script>
<style>
@import url(../../../css/boardList.css);
</style>