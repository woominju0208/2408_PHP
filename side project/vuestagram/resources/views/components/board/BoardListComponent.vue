<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <div v-for="item in boardList" :key="item" @click="openModal" class="item">
            <img :src="item.img">
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
import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

// computed는 콜백함수써야함
const boardList = computed(() => store.state.board.boardList);

// 백연결 (로그인후 보드리스트 출력)
// 비포 마운트 처리
onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        // action method 는 dispatch
        store.dispatch('board/getBoardListPagination');
    }
});








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