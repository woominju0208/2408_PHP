// 1.실시간 시계만들기
// 멈춰 클릭시 시간멈춤
// 재시작 클릭시 현재시간으로 리셋

// html id불러오기
const TARGET = document.querySelector('#clock');
// 시간 id 배열 만들어주기
let id = [];
// 시계함수 불러오기
clock();
// 시계 실행
let realClock = setInterval(clock,1000);
// 시간 id  realClock에 넣어주기
id.push(realClock);

// 시계 만들기
function clock() {
    const NOW = new Date();
    
    // 두글자해서 앞에 0 붙이기 

    // 시분초 구하기
    const HOUR = addLpadZeroHour(NOW.getHours(), 5);
    const MINUTE = addLpadZero(NOW.getMinutes(), 2);
    const SECOND = addLpadZero(NOW.getSeconds(), 2);

    function addLpadZeroHour (num, length) {
        if(num === 12) {
            return String().padStart(length, '오후 12');
        } else if(num === 24) {
            return String().padStart(length, '오전 00');
        } else if(num < 12) {
            return String(num).padStart(length, '오전 0');
        } else if(num > 12) {
            return String(num - 12).padStart(length, '오후 0');
        }
    }   
    function addLpadZero (num, length) {
            return String(num).padStart(length, '0');
        }

    // const AMPM = 'AM';
    // if(HOUR > 12) {
    //     const AMPM = 'PM';
    //     HOUR %= 12;
    // }

    // 시분초 바꿈
    // const FORMAT_DATE = `${HOUR}:${MINUTE}:${SECOND}`;
    // console.log(FORMAT_DATE);
    TARGET.textContent = `${HOUR}:${MINUTE}:${SECOND}`;
    const BODY = document.querySelector('p');
    BODY.appendChild(TARGET);

    // TARGET_APM.innerHTML = `${AMPM}`;
}
// clock 함수 끝

const STOP = document.querySelector('#stop');
const RESTART = document.querySelector('#restart');

// 멈춰버튼 함수
function stopBtn() {
    // 시간 id를 배열안에 넣고 시계 멈추기
    id.forEach(realClock => {
        clearTimeout(realClock);
    })
    // 멈추면 시간 id 를 [] 빈배열로 다 삭제하기
    id = [];      
    // if(realClock === null) {
    //     clock();
    //     realClock = setInterval(clock,1000);
    // }
}

// 재시작버튼 함수
function restartBtn() {
    clock();
    realClock = setInterval(clock,1000);
    // 재시작 누를시 시간id 넣어주기
    id.push(realClock);
    // if(realClock === null) {
    //     clock();
    //     realClock = setInterval(clock,1000);
    // } 
}
// 재시작누르고 멈춰를 누르면 실행이 안되네...



STOP.addEventListener('click', stopBtn);
RESTART.addEventListener('click', restartBtn);
