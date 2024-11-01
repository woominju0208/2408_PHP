
// lpad 앞에 0 함수화
function leftPadZero(target, length) {
    return String(target).padStart(length, '0')
}

// 시계 함수화
function getDate() {
    // 새로운 객체 date를 인스턴스화
    const NOW = new Date();
    let hour = NOW.getHours();  // 시간획득(24시 포멧)
    let minute = NOW.getMinutes();  // 분 획득
    let second = NOW.getSeconds();  // 초 획득
    let ampm = hour < 12 ? '오전' : '오후'; // 오전, 오후
    let hour12 = hour < 13 ? hour : hour - 12;  // 시간(12시 포멧)
    
    let timeFormat = 
        `${ampm} ${leftPadZero(hour12, 2)}:${leftPadZero(minute, 2)}:${leftPadZero(second, 2)}`;

    document.querySelector('#time').textContent = timeFormat;
    // body 안에 id가 time인 부분에 timeFormat을 text로 출력
}


// 즉시실행함수를 사용(모듈화)
// 다른 부분에선 사용할수없고 필요한 멈춰,재시작에서만 실행할수 있도록 즉시실행함수에 넣음(메모리 감소)
(() => {
    getDate();  // 최초의 시계 바로 실행
    // 새롭게 시간 값을 받아오기 때문에 const시에는 재할당이 불가 해 let으로 받아옴 let은 값이 계속 바뀔수 있다
    // 전역으로 처리해서 재시작,멈춰일때 맞는 id를 가져올수 있게 함 
    // 타이머 시간은 500 이 적당 1000은 한박자 느리고 100은 너무 많이 요청을 보냄
    let intervalId = null;  // intervalId가 뭐가 들어가는지 보여주기 위해 null 작성
    intervalId = setInterval(getDate, 500);
    
    // 멈춰 버튼
    document.querySelector('#btn-stop').addEventListener('click', () => {
        clearInterval(intervalId);
        intervalId = null;
    });
    
    // 재시작 버튼
    // 재시작 누른후면 intervalId 가 다르기 때문에 밖에 전역으로 만든 let intervalId 로 두고
    // 재시작시에도 intervalId = setInterval(getDate, 500);으로 처리 함으로써 전역 let intervalId에 담기게 된다.
    // 그 후 멈춰를 누르면 전역 let intervalId 에 저장된 id를 지우게 된다.
    // intervalId가 비었을시에만 id를 넣어라
    document.querySelector('#btn-restart').addEventListener('click', () => {
        getDate();  // 재시작에도 최초의 시계 바로 실행
        if(intervalId === null) {
            intervalId = setInterval(getDate, 500);
        }
    });
})();
