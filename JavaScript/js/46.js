// setTimeout(() => {
//     console.log('A');
//     setTimeout(() => {
//          console.log('B');
//          setTimeout(() => {
//              console.log('C');
//          }, 1000);
//     }, 2000);
//  }, 3000);

//  프로미스 객체 생성
 function iAmSleepy(str, ms) {
    return new Promise((resolve, reject) => {   // reject는 안쓰면 안적어도 된다 => new Promise(resolve) => {
        setTimeout(() => {
            console.log(str);
            resolve();
        }, ms);
    });
 }

// 필요에 따라 체이닝기법, async, await 기법 을 사용한다.
// 기본적으로 체이닝기법을 쓰고 더 복잡해질수록  async, await를 사용
 iAmSleepy('A', 3000)
 .then(() => iAmSleepy('B', 2000))
 .then(() => iAmSleepy('C', 2000))
.catch(() => console.log('error'))
.finally(() => console.log('finally'));

async function test() {
    try {
        await  iAmSleepy('A', 3000);
        await  iAmSleepy('B', 2000);
        await  iAmSleepy('C', 1000);
    } catch (error) {
        console.log('error');
    } finally {
        console.log('finally');
    }
}
test()