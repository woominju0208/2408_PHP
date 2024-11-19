<template>
    <p>자식쪽 cnt : {{ props.cnt }}</p>
    <button @click="$emit('eventAddCnt')">자식쪽 증가</button>
    <!-- 부모쪽 이벤트 명(@eventAddCnt) 호출 -->

    <!-- 파라미터가 필요한 경우 -->
     <button @click="$emit('eventAddCntParam', 2)">자식쪽에서 증가2</button>

     <button @click="$emit('eventReset')">자식쪽 초기화</button>
</template>

<script setup>
import { defineProps } from 'vue';

    const props = defineProps({
        'cnt' : Number
        // 오는 데이터의 데이터타입을 맞춰줘야 함 당장의 오류가 안나더라도
        // 무조건 숫자가 오면 Number, 문자면 String 라고 맞춰줘야 함
    });
</script>

<style>

</style>
