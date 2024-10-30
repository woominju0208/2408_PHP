// 1
const BTN_START = document.querySelector('#btn_start');
BTN_START.addEventListener('click', () => {
    alert('안녕하세요. 숨어있는 div를 찾아주세요.');
});

function boxDokidoki() {
    alert('두근두근');
}

function boxFind() {
    alert('들켰다!');
        BOXFIND.removeEventListener('click', boxFind);
        DOKIDOKI.removeEventListener('mouseenter', boxDokidoki);
        BOXFIND.addEventListener('click', reHidden);
        BOXFIND.classList.toggle('display_none');  
}

function reHidden() {
    alert('숨는다~');
    BOXFIND.removeEventListener('click', reHidden);
    BOXFIND.addEventListener('click', boxFind);
    DOKIDOKI.addEventListener('mouseenter', boxDokidoki);
    BOXFIND.classList.toggle('display_none');
}

// function inputDisplay() {
//     REHIDDEN.addEventListener('click', 
//         () => {
//             const DISPLAY = document.querySelector('#box');
//             DISPLAY.classList.add('display_none');
//         }
//     );
// }

// 두근두근
const DOKIDOKI = document.querySelector('#box_near, #box');
DOKIDOKI.addEventListener('mouseenter', boxDokidoki);
// DOKIDOKI.addEventListener('mouseenter', () => {
   
// }
// , {once: true});

// const BOXFIND = document.querySelector('#box');
// BOXFIND.addEventListener('click', boxFind);

// 들켰다
const BOXFIND = document.querySelector('#box');
BOXFIND.addEventListener('click', boxFind);
// BOXFIND.addEventListener('click', () => {
//     BOXFIND.removeEventListener('click', boxFind);
//     DOKIDOKI.removeEventListener('mouseenter', boxDokidoki);  
//     }
// , {once: true});

// 숨는다
// BOXFIND.addEventListener('click', 
//     () => {
//         DELDISPLAY.classList.toggle('display_none');
//         // REHIDDEN.addEventListener('click', reHidden);
//         // DOKIDOKI.addEventListener('mouseenter', boxDokidoki);
//         // DELDISPLAY.addEventListener('click', () => {
//             // const DISPLAY = document.querySelector('#box');
//             // DISPLAY.classList.add('display_none');
//             // })
//         });
        
        // const DELDISPLAY = document.querySelector('#box');
        // const REHIDDEN = document.querySelector('#box_near, #box');







// // 두근두근 모달
// const BOX = document.querySelector('.box_near');
// BOX.addEventListener('mouseenter', boxDokidoki);

// // 클릭시 들켰다 모달(안뜸)
// const BOX_FIND = document.querySelector('#box');
// BOX_FIND.addEventListener('click', boxFind);


// // display_none 클래스 삭제, 들켰다 한번만 뜨기
// const DISPLAY_OFF = document.querySelector('#box');
// DISPLAY_OFF.addEventListener('click',
//      () => {
//         const DISPLAY = document.querySelector('#box');
//         DISPLAY.classList.remove('display_none');
//         BOX_FIND.removeEventListener('click', boxFind);
//      }
//      , {once: true}
// );

// // 숨는다 모달
// const RE_HIDDEN = document.querySelector('#box');
// RE_HIDDEN.addEventListener('click', reHidden);


// const HIDDEN = document.querySelector('.box_container');
// HIDDEN.addEventListener('click', () => {
//     const HIDDEN_NO = document.querySelector('.box_container');
//     HIDDEN.classList.remove('display_none');
// });