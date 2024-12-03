<template>
    <div class="board-list-box">
        <!-- (item.board_id) 로 모달 오픈시 board_id 를 보내주기 -->
        <div v-for="item in boardList" :key="item" @click="openModal(item.board_id)" class="item">
            <img :src="item.img">
        </div>
    </div>

    <!-- detail modal -->
    <div v-show="modalFlg" class="board-detail-box">
        <div v-if="boardDetail" class="item">
            <img :src="boardDetail.img">
            <hr>
            <p>{{ boardDetail.content }}</p>
            <hr>
            <div class="etc-box">
                <span>{{ boardDetail.user.name }}</span>
                <div class="etc-box">
                    <!-- 삭제버튼 v-if : 작성글의 user_id 와 로그인한 user_id와 같아야함 -->
                     <!-- userInfo 에 user_id가 존재 user 모듈에서 state에 userInfo가 존재 -->
                    <!-- <button v-if="boardDetail.user_id === $store.state.user.userInfo.user_id" @click="deleteModal(boardDetail.board_id)" class="btn btn-header btn-bg-red">삭제</button> -->
                    <button v-if="boardDetail.user_id === $store.state.user.userInfo.user_id" @click="openDeleteModal" class="btn btn-header btn-bg-red">삭제</button>
                    <button @click="closeModal" class="btn btn-header btn-bg-black">닫기</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal -->
    <div  v-show="deleteModalFlg" class="board-detail-box">
        <div v-if="boardDetail" class="item">
            <img :src="boardDetail.img">
            <hr>
            <h3>정말로 삭제 하시겠습니까?</h3>
            <hr>
            <div class="etc-box">
                <span>{{ boardDetail.user.name }}</span>
                <div class="etc-box">
                    <button @click="deleteModal(boardDetail.board_id)" class="btn btn-header btn-bg-red">삭제</button>
                    <button @click="deleteCloseModal" class="btn btn-header btn-bg-black">닫기</button>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>

import { computed, onBeforeMount, ref } from 'vue';
//  useStore 해야 store. ~ 가져올수 있음
import { useStore } from 'vuex';

const store = useStore();

// 보드상세 정보
const boardDetail = computed(() => store.state.board.boardDetail);
const boardList = computed(() => store.state.board.boardList);
const destroyBoard = computed(() => store.state.board.destroyBoard);

onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        store.dispatch('board/boardListPagination');
    }
});

// ----------------
// modal 관련
// ----------------
    // modal 숨기기
    const modalFlg = ref(false);
    // modal 열기
    const openModal = (id) => {
        store.dispatch('board/showBoard', id);
        modalFlg.value = true;
    };
    // modal 닫기
    const closeModal = () => {
        modalFlg.value = false;
    };

// ------------
// deleteModal
// ------------
const deleteModalFlg = ref(false);
// delete modal 열기
const openDeleteModal = () => {
    deleteModalFlg.value = true;
};
const deleteCloseModal = () => {
    deleteModalFlg.value = false;
};
const deleteModal = (id) => {
    store.dispatch('board/destroyBoard', id);
    // deleteModalFlg.value =false;
};
    

// ----------------
// 스크롤 이벤트
// ----------------
const boardScollEvent = () => {
    // 디바운싱
    if(store.state.board.controllFlg) {
        const docHeight = document.documentElement.scrollHeight;
        const winHeight = window.innerHeight;
        const nowHeight = window.scrollY;
        const viewHeight = docHeight - winHeight;

        // console.log(viewHeight, nowHeight);
        if(viewHeight <= nowHeight) {
            store.dispatch('board/boardListPagination');
        }
    }
}
window.addEventListener('scroll', boardScollEvent);

</script>
<style>
@import url(../../../css/boardList.css);
</style>