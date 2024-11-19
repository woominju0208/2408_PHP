<template>
<div v-for="item in products" :key="item">
     <h2 @click="openDetailModal(item)">{{ item.productName }}</h2>
     <p>{{ item.productContent }}</p>
     <p>{{ item.productPrice }}원</p>
</div>

<!-- detail modal -->
 <!-- vue 애니메이션 -->
<Transition name="detailModalAnimation">
    <div class="bg-modal-black" v-show="flgDetail">
        <div class="bg-modal-white">
            <h1>{{ detailProduct.productName }}</h1>
            <p>{{ detailProduct.productContent }}</p>
            <p>{{ detailProduct.productPrice }}원</p>
            <button @click="closeDetailModal">닫기</button>
        </div>
    </div>
</Transition>

</template>

<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const products = computed(() => store.state.board.products); 

// 상세 모달 제어
// 데이터바인딩 위해서 ref 실시간 표시
const flgDetail = ref(false);
const detailProduct = computed(() => store.state.board.detailProduct);

// 
const openDetailModal = (item) => {
    // commit은 모듈화안에 mutations에 있는것만 요청
    store.commit('board/setDetailProduct', item);
    flgDetail.value = true;
}

const closeDetailModal = () => {
    flgDetail.value = false;
}
</script>

<style scoped>
    .bg-modal-black {
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
    }

    .bg-modal-white {
        width: 80%;
        max-width: 500px;
        background-color: #fff;
        border-radius: 30px;
        margin: 20px auto;
        padding: 20px;
    }

    /* vue animation enter-from, enter-active, enter-to 고정 */
    /* class같이 Transition 에 name 를 주고 뒤에 붙여주면 쓸수 있다. */
    /* 모달 시작쪽 */
    .detailModalAnimation-enter-from {
        opacity: 0;
    }

    .detailModalAnimation-enter-active {
        transition: 1s ease;
    }

    .detailModalAnimation-enter-to {
        opacity: 1;
    }

    /* 모달 끝쪽 */
    .detailModalAnimation-leave-from {
        /* transform: translateX(0px); */
        transform: scale(1.2);
    }

    .detailModalAnimation-leave-active {
        transition: all 4s;
    }

    .detailModalAnimation-leave-to {
        /* transform: translateX(4000px); */
        transform: scale(0);
        
    } 
</style>