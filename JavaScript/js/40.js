// 이벤트는 용량을 많이 잡아먹기 때문에 많이 쓰는건 좋지 않다.
// 함수선언
// 재할당 필수x
// 호이스팅이 됨
function inlineEventBtn() {
    alert('무한루프');
}

// // 함수표현
// // 재할당 필수
// // 호이스팅이 되지 않음
// const inlineEventBtn = () => {

// }
// --------------------------------
// inline ()

// 색깔바꾸기
function changeTitle() {
    const TITLE = document.querySelector('#title');
    TITLE.style.color = 'black';
}

// // 버튼 클릭시 계속 색깔바꾸기
// function changeTitle() {
//     const TITLE = document.querySelector('#title');
//     const BASE_COLOR = 'black';
//     const CHANGE_COLOR = 'red';
//     const currentColor =TITLE.style.color;
//     if(currentColor === BASE_COLOR ) {
//         TITLE.style.color = CHANGE_COLOR;
//     } else {
//         TITLE.style.color = BASE_COLOR;
//     }
// }
// 특정영역에서 사용하는 요소는 밖에다 전역에 선언이 아니라 그 함수안에 넣어서 지역요소로 넣어야 한다. 

// h1에 버튼 클릭시 클래스 title-click 추가하기
const TITLE = document.querySelector('h1');
function changeTitle() {
    TITLE.classList.add('title-click');
}

// --------------------------------
// addEventListener() (자주씀)
const BTN_LISTENER = document.querySelector('#btn1');
BTN_LISTENER.addEventListener('click',callAlert);

// BTN_LISTENER.addEventListener('click', () => {
//     alert('22222222222');
// });
// // addEventListener 는 동일한 이벤트를 여러번 넣을수 있다.(중복으로 주는 경우는 관리가 힘들어 만드는건 좀..)

function callAlert() {
    alert('이벤트 리스너 실행');
}
// 함수선언으로 호이스팅이 되서 밑에 있어도 실행이된다.
// 함수표현이었으면 제일 위에 썼었어야 했다.

// 토글버튼 클릭시 색깔이 바뀌고 돌아오고 만들기
const BTN_TOGGLE = document.querySelector('#btn_toggle');
BTN_TOGGLE.addEventListener('click', () => {
    const TITLE = document.querySelector('h1');
    TITLE.classList.toggle('title-click');
});

// 버튼 클릭시 넣기 더블 클릭시 빼기 (이상한거)
// const CHANGE_COLOR_TOGGLE = document.querySelector('#btn_toggle');
// CHANGE_COLOR_TOGGLE.addEventListener('click', () => {
//         TITLE.classList.add('title-click')  
// });
// CHANGE_COLOR_TOGGLE.addEventListener('dblclick', () => {
//     TITLE.classList.remove('title-click')
// });

// --------------------------------
// removeEventListener()
// 함수를 수정,삭제할시에는 함수를 따로 만들어주고 그 함수이름만 적어야 한다.
// 익명함수x ( () => {    alert('이벤트 리스너 실행');} )
// callAlert() 이렇게 쓰면 함수 호출로 ()을 빼야함
BTN_LISTENER.removeEventListener('click',callAlert);


// 일회성으로 alert창을 넣고 싶을때 (한번뜨고 다시 뜨지 않음)
const CLICK_H2 = document.querySelector('h2');
CLICK_H2.addEventListener('click',clickH2);

function clickH2() {
    alert('테스트용');
    // CLICK_H2.removeEventListener('click',clickH2);
}

// h1 글씨에 갖다댈 시 alert창이 뜨지 않음
TITLE.addEventListener(
    'mouseenter'
    , () => {
        CLICK_H2.removeEventListener('click', clickH2);
        console.log('ttt');     // h1에 갖다댈시 ttt 찍힘
    }   
    , {once: true}      // option : once가 true일 경우 한번만 실행
);


// --------------------------------
// 이벤트 객체
// php 슈퍼글로벌 변수처럼 자바스크립트내에서 자동으로  각각 요소의 많은 정보가 저장된다.
const H3 = document.querySelector('h3');
H3.addEventListener('mouseup', (e) => {
    // console.log(e);
    e.target.style.color = 'red';
});
H3.addEventListener('mousedown', (e) => {
    e.target.style.color = 'blue';
});
H3.addEventListener('mouseenter', (e) => {
    e.target.style.color = 'purple';
});
H3.addEventListener('mouseleaver', (e) => {
    e.target.style.color = 'orange';
});

// 모달
const BTN_MODAL = document.querySelector('#btn_modal');
BTN_MODAL.addEventListener('click', () => {
    const MODAL = document.querySelector('.modal_container');
    MODAL.classList.remove('display_none');
});

// 모달 닫기
const MODAL_CLOSE = document.querySelector('#modal_close');
MODAL_CLOSE.addEventListener('click', () => {
    const MODAL = document.querySelector('.modal_container');
    MODAL.classList.add('display_none');
});

// 팝업
const NAVER = document.querySelector('#naver');
NAVER.addEventListener('click', () => {
    open('http://www.naver.com', '_blank', 'left=100 width=400 height=500');
    open('http://www.google.com', '_blank', 'top=5000 width=800 height=300');
    open('https://kr.pinterest.com', '_blank', 'left=1000 width=1000 height=1000');
    // open 앞에 window. 생략가능
});
