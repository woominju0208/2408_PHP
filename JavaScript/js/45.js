// promise 객체
// resolve => then
// reject => catch
// ---------------
function iAmSleep(flg) {
    return new Promise((resolve, reject) => {
        if(flg) {
            resolve('성공');
        } else {
            reject('실패');
        }
    });
}
iAmSleep(true)
// 화살표함수로 함수형식 생략
.then(data => console.log(data))
// 화살표함수로 함수형식 생략
.catch(error => console.error(error))
// finally는 제일 끝에 찍히는것으로 () => 콜백함수 필수
// finally가 필수는 아님 , 끝에 적을 처리가 없으면 안 적어도 된다.
.finally(() => console.log('파이널리'))
; 
// // 둘이 같음
// data => console.log(data);

// function(data) {
//     console.log(data);
// }







// setTimeout(() => {
//     console.log('A');
//     setTimeout(() => {
//          console.log('B');
//          setTimeout(() => {
//              console.log('C');
//          }, 1000);
//     }, 2000);
//  }, 3000);



// //  프로미스 객체 생성
//  function iAmSleepy(str, ms) {
//     return new Promise((resolve, reject) => {   // reject는 안쓰면 안적어도 된다 => new Promise(resolve) => {
//         setTimeout(() => {
//             console.log(str);
//             resolve();
//         }, ms);
//     });
//  }

//  // A > B > C 순으로 출력
//  iAmSleepy('A', 3000)
//  .then(() => iAmSleepy('B', 2000))
//  .then(() => iAmSleepy('C', 1000));

// // A > C > B 순으로 출력
//  iAmSleepy('A', 3000)
//  .then(() => {
//     iAmSleepy('B', 2000);
//     iAmSleepy('C', 1000);
//  });