<template>
    <h1 @click="addCnt">{{ cnt }}</h1>
    <hr>
    <input type="text" v-model="tel">
    <span :style="color">{{ msg }}</span>
</template>
<script setup>
import { ref, watch } from 'vue';

// Watchers
const tel = ref('');
const msg = ref('X');
const color = ref('color:red;');

// watch를 쓰면 데이터바인딩한 객체가 바뀔수록 실시간으로 감지를 함
watch(tel, (val) => {
    // 유효성 체크
    const regex = /^[0-9]{10,11}$/;
    // 값val 이 유효성체크에 해당하지 않으면 빨간색x
    if(!regex.test(val)) {
        msg.value = 'X';
        color.value = 'color:red;';
        // 그밖에는 초록색o 
    } else {
        msg.value = 'O';
        color.value = 'color:green;';
    }
});

// --------------------------------
const cnt = ref(0);
// function addCnt() {
//     cnt.value++;
// }

const addCnt = () => {
    cnt.value++;
}
</script>
<style>

</style>