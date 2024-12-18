// --------------
// Math 객체 (number 타입)
// --------------
// 올림, 반올림, 버림
Math.ceil(0.1);  // 1
Math.round(0.5); // 1
Math.floor(0.9); // 0

// ---------------------------------

// 랜덤값
// 실제론 랜덤함수만 써서 랜덤값을 뽑진 않는다.
Math.random(); // 0 ~ 1 사이의 랜덤한 값을 획득
Math.floor(Math.random() * 10) + 1; // 1~10 랜덤 숫자

// console.log('start');
// for(let i = 0; i < 1000; i++) {
//     let test = Math.floor(Math.random() * 10) + 1;
//     if(test === 10 ) {
//         console.log('10나옴');
//     }
// }
// console.log('end');

// ---------------------------------

// 최대값
let arr = [1,2,3,4,5];

Math.max(1,2,100,3,2000,10,29);     // 2000 출력
Math.max(...arr);   // 5 출력
// ... => 배열의 값들만 들고 온다.(스프레드)

// ---------------------------------

// 최소값
Math.min(3,5,2,1,0);    // 0
Math.min(...arr);       // 1

// ---------------------------------

// 절대값
Math.abs(-1);   // 1
Math.abs(1);    // 1
// ex) 5000-20000 = -15000 을 절대값 15000으로 반환
