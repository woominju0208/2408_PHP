// 리스트에 새로운 요소 넣고 CSS 적용하기
// const NEW_LI = document.createElement('li');
// NEW_LI.textContent = '장기';

// const GAME = document.querySelector('#ul');

// const TARGET = document.querySelector('#ul :nth-child(4)');
// GAME.insertBefore(NEW_LI, TARGET);

// const BGCOLOR = document.querySelector('#ul :nth-child(10)');
// BGCOLOR.style.background = 'beige';

// const LI = document.querySelectorAll('li');
// LI.forEach((Element, idx)  => {
//     if(idx % 2 === 1) {
//         Element.style.color = 'blue';
//     } else{
//         Element.style.color = 'red';
//     }
// }); 

// ---------------------------------------------------------------------

// 숨겨진 박스 찾기
// const BTN = document.querySelector('#btn');
// BTN.addEventListener('click', () => {
//     alert('숨겨진 div를 찾아주세요.');
// });

// function boxDokidoki() {
//     alert('두근두근');
// }

// function boxFind() {
//     alert('들켰다!');
//     FIND.removeEventListener('click', boxFind);
//     FIND.removeEventListener('mouseenter', boxDokidoki);
//     NEAR.removeEventListener('mouseenter', boxDokidoki);
//     FIND.addEventListener('click', boxHide);
//     FIND.classList.toggle('hidden');
// }

// function boxHide() {
//     alert('숨는다~~');
//     // FIND.removeEventListener('click', boxFind);
//     FIND.removeEventListener('click', boxHide);
//     FIND.addEventListener('click', boxFind);
//     FIND.addEventListener('mouseenter', boxDokidoki);
//     // FIND.removeEventListener('click', boxDokidoki);
//     FIND.classList.toggle('hidden');
// }

// const NEAR = document.querySelector('.box_near');
// NEAR.addEventListener('mouseenter', boxDokidoki);

// const FIND = document.querySelector('.box');
// FIND.addEventListener('click', boxFind);

// ---------------------------------------------------------------------

// 타이머별로 텍스트 바뀌기
const TEXT1 = '( •̀ ω •́ )';
const TEXT2 = '( •̀ ω •́ )✧ <span style= color:pink;>❤ ❤ ❤</span>';

(() => {
    const P = document.createElement('p');
    P.innerHTML = TEXT1;
    P.style.fontSize = '5rem';
    document.body.appendChild(P);
})();

setInterval(() => {
    const P = document.querySelector('p');
    if(P.innerHTML === TEXT1) {
        P.innerHTML = TEXT2;
    } else {
        P.innerHTML = TEXT1;
    }    
}, 500);

// 문제점
// 1. setInterval 시 const P가져오는 과정을 querySelector 이 아닌 createElement를 써버림
// (createElement 는 새로운 요소를 만들시 사용 , 가져올때는 querySelector)
// 2. if 비교에서 P.innerHTML 와 TEXT1,TEXT2 가 완전히 같은 === 를 써버림
// (완전 비교가 될수 없기 때문에 바뀌지 않았음  === 에서 = 로 수정)


const TIME = 
    setInterval(() => {
        console.log('a');
    }, 1000);


clearInterval(TIME);

// setInterval(() => {
//     console.log('a');
//     clearInterval(setInterval);    
// }, 1000);