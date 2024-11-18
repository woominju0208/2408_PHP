<!-- vue는 쓰지 않는 불필요한건 다 지워줘야한다. 오류남 데이터바인딩이나 click요소를 넣고 안쓴다면 무조건 지워줘야 함 -->
<template>
  <!-- 자식 컴포넌트 호출 -->
  <BoardComponent />


  <!-- 리스트 랜더링(반복문) -->
  <!-- v-for -->
  <!-- 단순 반복 -->
  <div v-for="val in 5" :key="val">
    <p>{{ val }}</p>
  </div>
  <hr>
  <!-- 구구단 -->
  <!-- <div v-for="val1 in 8" :key="val1">
    <p>**** {{ val1+1 }}단 ****</p>
    <div v-for="val2 in 9" :key="val2">
      <p>{{ val1+1 }} X {{ val2 }} = {{ (val1+1) * val2 }} </p>
    </div>
  </div> -->
 <!-- 구구단 정답 -->
  <!-- <div v-for="dan in 9" :key="dan">
    <span>{{ `${dan} 단` }}</span>
    <div v-for="val in 9" :key="val">
      <span>{{ `${dan} X ${val} = ${(dan * val)}` }}</span>
    </div>
  </div> -->

  <div v-for="(item, idx) in data" :key="item">
    <p>{{ `${idx}번째 ${item.name} - ${item.age} - ${item.gender}` }}</p>
  </div>
  <button @click="data.pop()">삭제</button>


  <!-- 조건부 랜더링 -->
   <!-- v-if -->
  <h1 v-if="cnt === 7">☆럭키비키☆</h1>
  <h1 v-else-if="cnt >= 5">5이상 입니다.</h1>
  <h1 v-else-if="cnt < 0">음수입니다.</h1>
  <h1 v-else>0 ~ 4입니다.</h1>

  <!-- v-show -->
  <h1 v-show="flgShow">브이 쇼</h1>
  <button @click="flgShow = !flgShow">브이 쇼 토글</button>

  <h1>{{ cnt }}</h1>
  <!-- 버튼에 id값줘서 addeventlister 클릭이벤트나 onclick를 줘서 함수에 증가 함수를 줘야했지만
        @click="cnt++" 로 적으면 증가  -->
        <!-- 실제론 @click에 직접적으로 ++, -- 를 적지않고 함수를 적는다. -->
  <button @click="addCnt">증가▲</button>
  <button @click="disCnt">감소▼</button>
  <hr>
  <h2>이름 : {{ userInfo.name }}</h2>
  <!-- 데이터바인딩한 값에 클래스를 주기 위해선 : 을 붙여서 클래스 작성 -->
  <h2 :class="ageBlue">나이 : {{ userInfo.age }}</h2>
  <h2>성별 : {{ userInfo.gender }}</h2>
  <button @click="changeName">이름 변경</button>
  <button @click="changeAgeBlue">나이 파란색으로</button>
  <hr>
  <!-- v_model : 양방향데이터바인딩을 사용하게 해주는 것 주로 input에 씀 -->
  <!-- 실시간으로 유저가 작성한 데이터가 적용 -->
  <input type="text" v-model="transgender">
  <button @click="userInfo.gender = transgender">성별 변경</button>
  <!-- text박스에 작성하는 텍스트 실시간 출력 가능 -->
  <p>{{ transgender }}</p>
  <hr>


</template>

<!-- setup 이라 선언해야 사용가능 -->
<script setup>
// import로 자식 컴포넌트 호출
import BoardComponent from './components/BoardComponent.vue';
// ref, reactive 사용시 필수
import { reactive, ref } from 'vue';

const data = reactive([
  {name: '홍길동', age: 20, gender: '남자'}
  ,{name: '김영희', age: 12, gender: '여자'}
  ,{name: '둘리', age: 41, gender: '수컷'}
]);

// --------------------------------

const flgShow = ref(true);

// 양방향 데이터 바인딩(v-model)

const transgender = ref('');

  // ----------ref----------
  // 브이쇼 깜박임
  // (() => {
  //   setInterval(() => {
  //     flgShow.value = !flgShow.value;
  //   }, 500);
  // })();


const ageBlue = ref('');

function changeAgeBlue() {
  ageBlue.value = 'blue';
}

// ref() :함수
// 데이터바인딩 선언은 ref()
// 데이터바인딩들은 객체기 때문에 자바스크립트에 접근할때는 .value까지 적어줘야 한다.
// ref 안에는 단순한 값이 아닌 여러 요소가 있고 그중 ref(0)의 0은 value이다.
  const cnt = ref(0);
  // console.log(cnt);

  // ----------reactive----------
  // reactive는 객체기 때문에 {}안에 여러 요소를 적어주면 된다.
  // 객체면 reactive를 사용
  const userInfo = reactive({
    name: '홍길동'
    ,age: 20
    ,gender: 'undefind'
  });

  function addCnt() {
    cnt.value++;
  }

  function disCnt() {
    cnt.value--;
  }

  function changeName() {
    userInfo.name = '갑순이';
  }


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

.blue {
  color: #0000ff;
}
</style>
