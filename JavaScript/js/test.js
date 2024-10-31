
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

const BTN = document.querySelector('#btn');
BTN.addEventListener('click', () => {
    alert('숨겨진 div를 찾아주세요.');
});

function boxDokidoki() {
    alert('두근두근');
}

function boxFind() {
    alert('들켰다!');
    FIND.removeEventListener('click', boxFind);
    FIND.removeEventListener('mouseenter', boxDokidoki);
    NEAR.removeEventListener('mouseenter', boxDokidoki);
    FIND.addEventListener('click', boxHide);
    FIND.classList.toggle('hidden');
}

function boxHide() {
    alert('숨는다~~');
    // FIND.removeEventListener('click', boxFind);
    FIND.removeEventListener('click', boxHide);
    FIND.addEventListener('click', boxFind);
    FIND.addEventListener('mouseenter', boxDokidoki);
    // FIND.removeEventListener('click', boxDokidoki);
    FIND.classList.toggle('hidden');
}

const NEAR = document.querySelector('.box_near');
NEAR.addEventListener('mouseenter', boxDokidoki);

const FIND = document.querySelector('.box');
FIND.addEventListener('click', boxFind);




