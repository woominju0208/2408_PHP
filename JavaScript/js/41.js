// 타이머 함수
// -------------------------------
// // 동기 처리와 비동기 처리
// // 컴퓨터는 동기 처리 : 위에 코드가 완료되면 다음 코드가 실행됨
// // 동기처리 : 코드의 순서대로 실행 위부터 실행 후 끝나면 다음 실행
// // 비동기처리 : 코드의 순서 상관없이 한번에 동시에 실행, 자바스크립트 특성(버그발생이 쉬워짐)
// // 비동기 : setTimeout, setInterval, removeEventListener, addEventListener, ajax

// -------------------------------

// setTimeout(callback, ms) : 일정시간이 흐른 후에 콜백 함수를 실행
// 딱 한번만 실행
// 비동기처리

setTimeout(() => {
   console.log('시간초과'); 
}, 5000);   // 1초 = 1000ms , 5초뒤 시간초과 출력


// C > B > A 순으로 출력, 총 3초 소요
setTimeout(() => console.log('A'), 1000);
setTimeout(() => console.log('B'), 2000);
setTimeout(() => console.log('C'), 3000);


// A > B > C 순으로 출력, 총 6초 소요 
setTimeout(() => {
   console.log('A');
   setTimeout(() => {
        console.log('B');
        setTimeout(() => {
            console.log('C');
        }, 1000);
   }, 2000);
}, 3000);
// 콜백지옥.......
// 비동기 처리안에 넣으면서 동기처리처럼 보이게 하는것이다.(동기처리가 된건 아님)

// clearTimeout(타이머ID) : 해당 타이머ID의 처리를 제거
const TIMER_ID = setTimeout(() => console.log('타이머'), 10000);    // 10초후 '타이머' 출력
console.log(TIMER_ID);      // setTimeout의 고유한 id
clearTimeout(TIMER_ID);     // TIMER_ID 의 세팅한 타임아웃('타이머')을 제거

// -------------------------------

// setInterval(callback, ms) : 일정 시간 마다 콜백함수를 실행
const INTERVAL_ID = setInterval(() => {
    console.log('인터벌');       
}, 1000);
console.log(INTERVAL_ID);
// clearInterval(INTERVAL_ID);

// '인터벌 '10초까지만 찍히는 타이머
setTimeout(() => {
    clearInterval(INTERVAL_ID)    
}, 10000);

// html에 출력하기
// const TEXT = document.createElement('h1');
// TEXT.textContent = '두둥등장';
// TEXT.style.color = 'black';
// const TEXT1 = document.createTextNode('두둥등장');
// TEXT.appendChild(TEXT1);
// document.body.appendChild(TEXT);

// document.body.innerHTML = '<h1>두둥등장</h1>';

const NEW_H1 = document.createElement('p');
NEW_H1.textContent = '두둥등장';
NEW_H1.classList.add('blue');

const BODY = document.querySelector('body');
BODY.appendChild(NEW_H1);



// set 시간 설정 css추가 > css삭제
// 추가는 했지만 아직 삭제 못함
setInterval(() => {
    const COLOR = document.querySelector('p');
    // const COLORCHANGE = COLOR.classList.add('blue'); 
    // clearInterval(COLORCHANGE)
    COLOR.classList.toggle('blue');
    COLOR.classList.toggle('red');          
}, 100);

// 정답
(() => {
    const H1 = document.createElement('h1');
    H1.textContent = '두둥등장';
    H1.classList.add('blue');
    H1.style.fontSize = '5rem';

    // body는 최상위 객체라 따로 가져올 필요없이 document 가능
    document.body.appendChild(H1);
})();

setInterval(() => {
    const H1 = document.querySelector('h1');
    H1.classList.toggle('blue');
    H1.classList.toggle('red');
}, 200);