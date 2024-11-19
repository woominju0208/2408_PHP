<template>
  <img alt="Vue logo" src="./assets/logo.png"> 
  <!-- <h1>{{ count }}</h1> -->
  <!-- commit('모듈화/호출할 메소드명') -->
  <!-- <button @click="store.commit('board/addCount')">증가</button>  -->

  <!-- <BoardListComponents /> -->
  <TestComponents />

</template>

<script setup>
// import BoardListComponents from './components/BoardListComponents.vue';
import TestComponents from './components/TestComponents.vue';


// 반응형 데이터로 다루기 위해 computed 이용
// store에도 모듈board처럼 state, mutations, actions, getter가 존재 > 다음 모듈이름을 선택 > 객체안에 프로퍼티
// const count = computed(() => store.state.board.count);

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
