const TEST = document.querySelectorAll('.none-li');
// TEST.style.color = 'blue';

TEST.forEach((element, idx) => {
    element.style.color = 'blue'
});

const NEW_LI = document.createElement('li');
NEW_LI.textContent = '장기';
NEW_LI.style.color = 'red';

const GAME = document.querySelector('#ul');

const TARGET = document.querySelector('#ul :nth-child(4)');
GAME.insertBefore(NEW_LI, TARGET);
