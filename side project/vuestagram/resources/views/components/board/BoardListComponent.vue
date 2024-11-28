<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <!-- 게시글 번호(board_id)를 openModal의 파라미터로 전달 -->
        <div v-for="item in boardList" :key="item" @click="openModal(item.board_id)" class="item">
            <img :src="item.img">
        </div>
    </div>

    <!-- 상세 모달 -->
     <div v-show="modalFlg" class="board-detail-box">
        <!-- v-if : boardDetail 이 존재할때만 출력 조건 -->
        <div v-if="boardDetail" class="item">
               <!-- v-if조건으로 모달이 실행은 되지만 처음 설정이 null로 모달내용은 출력이 안되지만 content를 클릭했을때 생겨서 보이는것 -->
            <img :src="boardDetail.img">
            <hr>
            <p>{{ boardDetail.content }}</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : {{ boardDetail.user.name}}</span>
                <button @click="closeModal" class="btn btn-bg-black btn-header">닫기</button>
            </div>
        </div>
     </div>
</template>
<script setup>
import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

// 보드 상세 정보
const boardDetail = computed(() => store.state.board.boardDetail);

// computed는 콜백함수써야함
const boardList = computed(() => store.state.board.boardList);


// 백연결 (로그인후 보드리스트 출력)
// 비포 마운트 처리
onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        // action method 는 dispatch
        store.dispatch('board/boardListPagination');
    }
});

// -------------------------
// 스크롤 이벤트 관련
const boardScrollEvent = () => {
    // 디바운싱
    if(store.state.board.controllFlg) {
        const docHeight = document.documentElement.scrollHeight;    // 문서 기준 Y축 총 길이
        const winHeight = window.innerHeight;                       // 윈도우의 Y축 총 길이
        const nowHeight = window.scrollY;                       // 현재 스크롤 위치
        const viewHeight = docHeight - winHeight;               // 끝까지 스크롤 했을 때 Y축 위치

        // console.log(viewHeight, nowHeight);
        if(viewHeight <= nowHeight) {
            store.dispatch('board/boardListPagination');
        }

    }


}

window.addEventListener('scroll', boardScrollEvent);
// -------------------------





// ------------------------
// 모달관련
const modalFlg = ref(false);
const openModal = (id) => {
    // console.log(id);    // 게시글 클릭시 id오는지 확인
    store.dispatch('board/showBoard', id);  // actions 에 showBoard 액션메소드 사용
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