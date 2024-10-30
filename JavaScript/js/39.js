// ----------------
// 요소 선택
// ----------------
// 고유한 ID로 요소를 선택
const TITLE = document.getElementById('title');
TITLE.style.color = 'blue';

// 태그명으로 요소를 선택하는 방법
const H1 = document.getElementsByTagName('h1');
H1[1].style.color = 'green';

// 클래스명으로 요소를 선택
const CLASS_NONE_LI = document.getElementsByClassName('none_li');

// CSS 선택자를 이용해서 요소를 선택
const SICK = document.querySelector('#sick');
const NONE_LI = document.querySelector('.none_li');
// 해당하는 요소가 여러개 있으면 가장 첫번째 것만 가져옴
const ALL_NONE_LI = document.querySelectorAll('.none_li');

// forEach 로 홀수 빨간색, 짝수 파란색
const LI =document.querySelectorAll('li');
LI.forEach((Element, idx) => {
    if(idx % 2 === 1) {
        Element.style.color = 'red';
    } else {
        Element.style.color = 'blue';
    }
});

// val = 'g'못가져옴
// LI.forEach((val, idx) => {
//     if(val ='햄버거') {
//         val.style.color = 'red';
//     } else {
//         val.style.color = 'blue';
//     }
// });

// LI.forEach((val,idx) => {
//     console.log(`${val} : ${idx}`);
// })

// const ARR1 = [1,2,3,4];
// const ARR2 = [
//     {id : 1, name: '홍길동'}
//     ,{id : 1, name: '고길동'}
// ];
// ARR2.forEach((item,idx) => {
//     console.log(item.name);
// });     // '홍길동', '고길동' 출력

// ----------------
// 요소 조작
// ----------------
// textContent : 컨텐츠를 획득 또는 변경, 순수한 텍스트 데이터를 전달
TITLE.textContent = '만두짱'
// TITLE.textContent = <a>링크</a> 이렇게 하면 <a>링크</a> 텍스트 그대로 적용된다.(순수한 텍스트)

// innerHTML : 컨텐츠를 획득 또는 변경, 태그는 태그로 인식해서 전달
// TITLE.innerHTML = '<a href="https://www.naver.com/">만두두두</a>';
TITLE.innerHTML = '<a>만두두두</a>';


// setAttribute(속성명, 값) : 해당 속성과 값을 요소에 추가
// querySelector 로 선택자를 정확히 줘야 한다.
const A_LINK = document.querySelector('#title > a');
A_LINK.setAttribute('href', 'https://www.naver.com');

const HAHAHA = document.querySelector('#input_1');
HAHAHA.setAttribute('placeholder', '하하하');

// removeAttribute(속성명) : 해당 속성 제거
A_LINK.removeAttribute('href');     // href 제거

// ----------------
// 요소의 스타일링
// ----------------
// style : 인라인으로 스타일 추가, 우선순위가 높음
TITLE.style.color = 'black';
TITLE.removeAttribute('style');

// classList : 클래스로 스타일 추가 및 삭제
// 예를 들어 사이트에서 클릭시 클래스가 생겼다 없어졌다 하는건 자바스크립트에서 classList한 것이다.
// classList.add() : 해당 클래스 추가
TITLE.classList.add('class_1');
TITLE.classList.add('class_2', 'class_3', 'class_4');   // 여러 클래스 추가 가능

// classList.remove() : 해당 클래스 제거
TITLE.classList.remove('class_3');

// classList.toggle() : 해당 클래스를 ON/OFF
TITLE.classList.toggle('toggle');


// ----------------
// 새로운 요소 생성
// ----------------
// createElement(태그명) : 새로운 요소 생성
const NEW_LI = document.createElement('li');
// textContent, innerHTML
NEW_LI.textContent = '떡볶이';
NEW_LI.style.color = 'red';

// document.body;  : 부모 body태그는 querySelector를 안적어도 된다.

const FOODS = document.querySelector('#foods');

// appendChild(노드) : 해당 부모 노드의 마지막 자식으로 노드를 추가
FOODS.appendChild(NEW_LI);      // li 제일 끝에 '떡볶이' 추가

// removeChild(노드) : 해당 부모 노드의 자식 노드를 삭제
FOODS.removeChild(NEW_LI);      // li 제일 끝에 '떡볶이' 삭제

// insertBefore(새로운노드, 기준노드) : 해당 부모 노드의 자식인 기준 노드의 앞에 새로운 노드를 추가
const TARGET = document.querySelector('#foods :nth-child(6)');
FOODS.insertBefore(NEW_LI, TARGET);
// FOODS.insertBefore(NEW_LI, SICK);   // SICK가 유산균으로 유산균 위에 처리 된다. 