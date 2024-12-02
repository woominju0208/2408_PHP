<template>
    <div class="board-list-box">
        <div v-for="item in boardList" :key="item" @click="openModal" class="item">
            <img :src="item.img">
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

import { computed, onBeforeMount, ref } from 'vue';
//  useStore 해야 store. ~ 가져올수 있음
import { useStore } from 'vuex';

const store = useStore();
const boardList = computed(() => store.state.board.boardList);

onBeforeMount(() => {
    store.dispatch('board/getBoardListPagination');
});

// ----------------
// modal 관련
// ----------------
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