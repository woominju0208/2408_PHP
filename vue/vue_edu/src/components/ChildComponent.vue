<template>
    <slot></slot>
    
    <h1>자식 컴포넌트</h1>
    <!-- vue는 기존 부모자식 상속관계가 아님 -->
     <div v-for="item in props.data" :key="item">
        <span>{{ item.name }}</span>
     </div>
     <!-- 부모의 count 출력 부모가 값이 변경되면 실시간 변경 -->
     <p>{{ props.count }}</p>

</template>

<script setup>
    import { defineProps } from 'vue';
    // props는 객체
    const props = defineProps({
        // key값 : 넘겨주는 데이터 타입
        'data' : Array
        ,'count' : Number
    });
</script>


<style>

</style>