// // 1
// const BTN_START = document.querySelector('#btn_start');
// BTN_START.addEventListener('click', () => {
//     alert('안녕하세요. 숨어있는 div를 찾아주세요.');
// });

// function boxDokidoki() {
//     alert('두근두근');
// }

// function boxFind() {
//     alert('들켰다!');
//         BOXFIND.removeEventListener('click', boxFind);
//         DOKIDOKI.removeEventListener('mouseenter', boxDokidoki);
//         BOXFIND.addEventListener('click', reHidden);
//         BOXFIND.classList.toggle('display_none');  
// }

// function reHidden() {
//     alert('숨는다~');
//     BOXFIND.removeEventListener('click', reHidden);
//     BOXFIND.addEventListener('click', boxFind);
//     DOKIDOKI.addEventListener('mouseenter', boxDokidoki);
//     BOXFIND.classList.toggle('display_none');
// }

// // function inputDisplay() {
// //     REHIDDEN.addEventListener('click', 
// //         () => {
// //             const DISPLAY = document.querySelector('#box');
// //             DISPLAY.classList.add('display_none');
// //         }
// //     );
// // }

// // 두근두근
// const DOKIDOKI = document.querySelector('#box_near, #box');
// DOKIDOKI.addEventListener('mouseenter', boxDokidoki);
// // DOKIDOKI.addEventListener('mouseenter', () => {
   
// // }
// // , {once: true});

// // const BOXFIND = document.querySelector('#box');
// // BOXFIND.addEventListener('click', boxFind);

// // 들켰다
// const BOXFIND = document.querySelector('#box');
// BOXFIND.addEventListener('click', boxFind);
// // BOXFIND.addEventListener('click', () => {
// //     BOXFIND.removeEventListener('click', boxFind);
// //     DOKIDOKI.removeEventListener('mouseenter', boxDokidoki);  
// //     }
// // , {once: true});

// // 숨는다
// // BOXFIND.addEventListener('click', 
// //     () => {
// //         DELDISPLAY.classList.toggle('display_none');
// //         // REHIDDEN.addEventListener('click', reHidden);
// //         // DOKIDOKI.addEventListener('mouseenter', boxDokidoki);
// //         // DELDISPLAY.addEventListener('click', () => {
// //             // const DISPLAY = document.querySelector('#box');
// //             // DISPLAY.classList.add('display_none');
// //             // })
// //         });
        
//         // const DELDISPLAY = document.querySelector('#box');
//         // const REHIDDEN = document.querySelector('#box_near, #box');







// // // 두근두근 모달
// // const BOX = document.querySelector('.box_near');
// // BOX.addEventListener('mouseenter', boxDokidoki);

// // // 클릭시 들켰다 모달(안뜸)
// // const BOX_FIND = document.querySelector('#box');
// // BOX_FIND.addEventListener('click', boxFind);


// // // display_none 클래스 삭제, 들켰다 한번만 뜨기
// // const DISPLAY_OFF = document.querySelector('#box');
// // DISPLAY_OFF.addEventListener('click',
// //      () => {
// //         const DISPLAY = document.querySelector('#box');
// //         DISPLAY.classList.remove('display_none');
// //         BOX_FIND.removeEventListener('click', boxFind);
// //      }
// //      , {once: true}
// // );

// // // 숨는다 모달
// // const RE_HIDDEN = document.querySelector('#box');
// // RE_HIDDEN.addEventListener('click', reHidden);


// // const HIDDEN = document.querySelector('.box_container');
// // HIDDEN.addEventListener('click', () => {
// //     const HIDDEN_NO = document.querySelector('.box_container');
// //     HIDDEN.classList.remove('display_none');
// // });



// 즉시 실행 함수
// 딱 한번만 실행하는 함수 , 최초에 실행되어야 하는 함수들에 사용
// 메모리를 덜 잡아 먹음

// 1. 숨어있는 div
(() => {
    const BTN_INFO = document.querySelector('#btn-info');
    BTN_INFO.addEventListener('click', () => {
        alert('안녕하세요.\n숨어있는 div를 찾아주세요.');
    });

    // 2. 두근두근
    const CONTAINER = document.querySelector('.container');
    CONTAINER.addEventListener('mouseenter', dokidoki);

    // 3. 들켰다
    const BOX = document.querySelector('.box');
    BOX.addEventListener('click', busted);
    
    // 처음 위치도 랜덤으로 생성
    // 하단 함수 선언후 사용
    random();
})()

// 두근두근 함수
function dokidoki() {
    alert('💖두근두근💖');
}

// 들켰다 함수
function busted() {
    alert('들켰다😆');
    const CONTAINER = document.querySelector('.container');
    const BOX = document.querySelector('.box');

    // 4. 들켰다, 두근두근 제거
    BOX.removeEventListener('click', busted);   // 기본 들켰다 제거
    // 5. 숨는다 추가
    BOX.addEventListener('click', hide);        // 숨는다 이벤트 추가
    BOX.classList.add('busted');    // 배경색 부여

    CONTAINER.removeEventListener('mouseenter', dokidoki);  // 두근두근 제거
}

// 숨는다 함수
function hide() {
    alert('숨는다~😜');
    const CONTAINER = document.querySelector('.container');
    const BOX = document.querySelector('.box');

    BOX.classList.remove('busted');     // 들켰다 배경색 제거
    BOX.addEventListener('click', busted);      // 들켰다 이벤트 추가
    BOX.removeEventListener('click', hide);     // 숨는다 이벤트 제거

    // 6. 다시 두근두근
    CONTAINER.addEventListener('mouseenter', dokidoki);     // 두근두근 이벤트 추가

    // 보너스. 랜덤위치로 이동
    // 다시 숨을때 위치 변경
    // 하단 함수로 선언후 사용
    random();
}


// 즉시실행함수를 통해 이벤트 실행시에만 사용하고 이벤트 처리 끝난후에는 메모리가 남지 않는다.(메모리 공간 차지 줄임)
// 즉시실행함수(지역스코프)가 아닌 전역 스코프 시에는 그 메모리들을 계속 들고있다.(메모리 공간 차지 많음)
// addEventListener 을 사용하면 Web API에 이벤트를 저장 그 함수를 실행시 이런 처리를 해 달라는 처리를 저장해서
// 즉시실행함수안에 넣고 처리가 끝났음에도 Web API에 저장되었기 때문에 실행할수 있음

// 랜덤위치 함수로 뺀 후 즉시함수랑 위쪽에 함수로 넣기 !!!
// 함수선언
function random() {
    const CONTAINER = document.querySelector('.container');
    const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
    const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));
    CONTAINER.style.top = RANDOM_Y + 'px';
    CONTAINER.style.left = RANDOM_X + 'px';
    console.log(RANDOM_X, RANDOM_Y);
}