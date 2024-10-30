// const TEST = document.querySelectorAll('.none-li');
// // TEST.style.color = 'blue';

// TEST.forEach((element, idx) => {
//     element.style.color = 'blue'
// });

const NEW_LI = document.createElement('li');
NEW_LI.textContent = '장기';

const GAME = document.querySelector('#ul');

const TARGET = document.querySelector('#ul :nth-child(4)');
GAME.insertBefore(NEW_LI, TARGET);

const BGCOLOR = document.querySelector('#ul :nth-child(10)');
BGCOLOR.style.background = 'beige';

const LI = document.querySelectorAll('li');
LI.forEach((Element, idx)  => {
    if(idx % 2 === 1) {
        Element.style.color = 'blue';
    } else{
        Element.style.color = 'red';
    }
}); 

