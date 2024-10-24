// if문
let num = 1;
if(num === 1) {
    console.log('1등');
} else if(num === 2) {
    console.log('2등');
} else if(num === 3) {
    console.log('3등');
} else {
    console.log('등수외');
}

// switch문
switch(num) {
    case 1:
        console.log('1등');
        break;
    case 2:
        console.log('2등');
        break;
    default:
        console.log('순위외');
        break;    
}

// for문 (2~9 단)
for(let dan = 2; dan <= 9; dan++) {
    console.log('** '+dan+'단 **');
    for(let gu = 1; gu <= 9; gu++) {
        console.log(dan+' X '+gu+' = '+(dan * gu));
    }
}

// for문 ( * 삼각형)
let str = '';
for(let i = 0; i < 5; i++) {
    for(let z = 5; z > 0; z--) {
        if(z - i > 1) {
            str += ' ';
        } else {
            str += '*';
        }
    }
    str += '\n';
}
console.log(str);

// // if 조건 없이
// let star = '';
// for(let i = 0; i < 5; i++) {
//     for(let z = 5; z > 0; z--) {
//         for() {

//         }
//     }
// }

// for...in : 모든 객체를 반복하는 문법, key에 접근
// php foreach 처럼 배열안을 반복문 돌린다.
const OBJ2 = {
    'key1' : 'val1'
    ,'key2' : 'val2'
};

for(let key in OBJ2) {
    console.log(OBJ2[key]);
}

// for...of : 이터러블(iterable) 객체를 반복하는 문법, value에 접근
// 요소들끼리 순서가 정해져있는데 순서대로 가져오는 것
// 이터러블 객체 : string , array
// console에서 쳐봤을때 length가 있는 객체는 이터러블 객체다.
// 문자 하나하나 (안,녕,하,세,요) 저장되어 있어서 문자가 아닌 문자열이다.

const STR1 = '안녕하세요';
for(let val of STR1) {
    console.log(val);
}

const ARR1 = [1,2,3];