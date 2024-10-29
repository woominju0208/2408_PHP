// ---------------------
// 배열
// 자바스크립트에서 배열은 객체
// php에선 key의 순서가 없었지만 자바스크립트,자바등은 key의 순서가 있다.
// ---------------------
const ARR1 = [1, 2, 3, 4, 5];
// const ARR2 = new Array(1,2,3,4,5); 위에와 같음 길어서 위와 같이 생략
// ARR1 이 array 의 객체이다.
// Array.ARR1.isArray(); 이런식으로 사용 불가능
// ARR1 = [0] 입력시 1 출력

// length
// 배열의 길이 획득
// 메소드가 아니고 프로퍼티이기 때문에 ()적지 않음
console.log(ARR1.length);

// ---------------------

// isArray()
// 배열인지 아닌지 체크 해주는 메소드
console.log(Array.isArray(ARR1));  // true
console.log(Array.isArray(1));  // false

// ---------------------

// indexOf()
// 배열에서 특정 요소를 검색하고, 해당 인덱스를 반환
// 해당 요소가 없으면 -1 반환
let i = ARR1.indexOf(4);
console.log(i);    // 3 출력

// ---------------------

// includes()
// 배열의 특정 요소의 존재여부를 체크, boolean 리턴
// 단순히 값의 존재여부를 체크할때는 includes()를 사용하는게 더 좋다.
let arr1 = ['홍길동', '갑순이', '갑돌이'];
let boo = arr1.includes('갑돌이');
console.log(boo);

// ---------------------

// push()
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length
// 어떤 메소드에 따라 원본이 변경되고 안되고 차이가 있다. , 원본변경
ARR1.push(10);
ARR1.push(20, 30, 50);   // 여러개도 추가 가능
// php 에선 ->였지만 자바스크립트는 '.' 이 붙는다.
ARR1[ARR1.length] = 100;
// 성능이슈 발생시 length를 이용해서 직접 요소를 추가할 것 (제일 마지막 100 추가)

// 배열 복사
// 객체는 기본적으로 얕은복사가 되므로 딥카피를 하기 위해서는 Spread Operator 를 이용
// 얕은 복사
const COPY_ARR1 = ARR1;
COPY_ARR1.push(9999);
// ARR1 과 COPY_ARR1 둘다 9999가 추가 되었다.(참조)
// 객체는 참조형식으로 되서 값자체를 복사하는게 아니라 값의 주소를 가져와 수정한다.(얕은 복사(shallow copy))
// 원본에 접근해서 값을 가져오고 수정한다. 새로운 값을 받은게 아니다.

// 깊은 복사
// Spread Operator
// 깊은 복사(deep copy) 원본을 보호, 복사시 새로운 객체를 만듬
const COPY_ARR2 = [...ARR1];   // ... 사용
COPY_ARR2.push(8888);

// ---------------------

// pop()
// 원본 배열의 마지막 요소를 제거, 제거된 요소를 반환, 원본변경
// 제거할 요소가 없으면 undefined를 반환
const ARR_POP = [1, 2, 3, 4, 5];
let resultPop = ARR_POP.pop();
console.log(resultPop);   // 5 출력 , ARR_POP에서 5 제거
// ARR_POP.length = 1;   이런식으로 해도 값이 제거가 되지만 오류가 날수 있으므로 pop을 써서 제거를 하자

// undefined 와 null은 전혀 다른 타입이다.

// ---------------------

// unshift()
// 원본 배열의 첫번째 요소를 추가, 변경된 length를 반환, 원본변경
const ARR_UNSHIFT = [1, 2, 3];
let resultUnshift = ARR_UNSHIFT.unshift(100);
console.log(resultUnshift);    // 4출력 앞에 100추가로 length 4출력
ARR_UNSHIFT.unshift(300,400,555,666);  // 여러개도 추가 가능

// ---------------------

// shift()
// 원본 배열의 첫번째 요소를 제거, 제거된 요소를 반환, 원본변경
// 제거할 요소가 없으면 undefined를 반환
const ARR_SHIFT = [1, 2, 3, 4];
let resultShift = ARR_SHIFT.shift();
console.log(resultShift);    // 1 출력(삭제한 요소) , ARR_SHIFT 시 [2,3,4] 출력

// ---------------------

// splice()
// 요소를 잘라서 자른 배열을 반환, 원본변경
let arrSplice = [1, 2, 3, 4, 5];
let resultSplice = arrSplice.splice(2);  // 2는 인덱스 번호
console.log(resultSplice);   // [3,4,5] 출력 /  2까지해서 3,4,5가 잘림
console.log(arrSplice);      // [1,2] 출력   /  3,4,5가 splice로 잘린 후 1,2 출력

// 시작을 음수로 할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(-2); 
console.log(resultSplice);   // [4,5] 출력   / 오른쪽부터 해서 4,5가 잘림
console.log(arrSplice);      // [1,2,3] 출력 / 4,5가 splice로 잘린 후 1,2,3 출력

// start, count를 모두 셋팅할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(1, 2);
console.log(resultSplice);  // [2,3] 출력   / 인덱스 1 = [2] 부터 해서 2개 잘림     / 인덱스 0 은 [1]
console.log(arrSplice);     // [1,4,5] 출력   / 2,3가 splice로 잘린후 1,4,5 출력

// 배열의 특정 위치에 새로운 요소를 추가
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 0, 999, 888);    // 인덱스2 는 3으로 3에서 0 안자르고 2~3사이에 999,888 추가
console.log(resultSplice);                     // []출력 / 아무것도 삭제 안함
console.log(arrSplice);                        // [1,2,999,888,4,5]출력 / 999,888추가

// 배열에서 특정요소를 새로운 요소를 변경
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 1, 999, 888);   // 인덱스2 는 3으로 3에서 1개 자르고(3자름) 2~4사이에 999,888 추가
console.log(resultSplice);    // [3]출력
console.log(arrSplice);       //  [1, 2, 999, 888, 4, 5] 출력


// ---------------------
// join()
// 배열의 요소들을 특정 구분자로 연결한 문자열을 반환 (php explode랑 똑같음)
let arrJoin = [1, 2, 3, 4];
let resultJoin = arrJoin.join(',');
console.log(resultJoin);    // 1,2,3,4 => 문자열로 반환(string)
console.log(arrJoin);       // [1,2,3,4] => 원본은 배열 그대로(array)

// ---------------------

// sort()
// 배열의 요소를 오름차순 정렬, 원본변경
// 파라미터를 전달하지 않을 경우에, 문자열로 변환 후에 정렬 (데이터가 문자열로 바뀌는건 아님)
let arrSort = [1,2,3,10,24,5,80,17];
// let resultSort = arrSort.sort();
// console.log(resultSort);    //  [1, 10, 17, 2, 24, 3, 5, 80] 출력
// console.log(arrSort);       //  [1, 10, 17, 2, 24, 3, 5, 80] 원본도 바뀜
// 파라미터 값을 넣지 않으면 a,ab,b순으로 가서 1... 2... 3... 이런식으로 가서 순서가 이상한거다.

// 파라미터 전달
let resultSort = arrSort.sort((a, b) => a - b);         // 오름차순
// let resultSort = arrSort.sort((a, b) => b - a);      // 내림차순

// a가 1이고 b엔 2가 들어간다.차례대로 배열안에 모든 값을 넣음 a - b를 했을때 음수면 바꾸지 않고 양수면 앞뒤를 바꿈 그래서 이 방식으로 계속 처리해서 낮은 숫자부터 높은 숫자로 출력
console.log(resultSort);
console.log(arrSort);

// ---------------------

// map()
// 배열에 모든 요소에 대해서 콜백 함수를 반복 실행한 후, 그 결과를 새로운 배열로 반환
// 배열안에 조건이있는 새로운 콜백함수를 만들어서 조건이 맞다면 짝 반환, 아니면 num 반환이다.
let arrMap = [1,2,3,4,5,6,7,8,9,10];
// foreach 와 비슷
let resultMap = arrMap.map(num => {
    if(num % 3 === 0) {
        return '짝';
    } else {
        return num;
    }
});
console.log(resultMap);
console.log(arrMap);


// function myCallBack() {
//     return 'myCallBack';
// }

// function myCallBack2(a,b) {
//     return 'myCallBack2';
// }

// function test(callback, flg) {
//     if(flg) {
//         console.log(callback());
//     } else {
//         console.log('콜백 실행 안됨');
//     }
// }

// function mySum(a, b){
//     console.log(a + b);
// }

// map의 콜백 로직(일회성)
const TEST = {
    entity : [1,2,3,4,5,6,7,8,9,10]
    ,length : 10
    ,map: function (callback) {
        let resultArr = [];

        for(let i = 0; i <this.entity.length; i++) {
            resultArr[resultArr.length] = callback(this.entity[i]);
        }
        return resultArr;
    }
}

let resultTest = TEST.map(testCallBack);

function testCallBack(num) {
    if(num % 3 === 0) {
        return '짝';
    }else {
        return num;
    }
}

// ---------------------

// filter()
// 배열의 모든 요소에 대해 콜백함수를 반복 실행하고, 조건에 만족한 요소만 배열로 반환 
let arrFilter = [1,2,3,4,5,6,7,8,9,10];
let resultFilter = arrFilter.filter(num => num % 3 === 0);
// ()안에 값이 ture 나 false로 나와야 한다.(boolean)
console.log(resultFilter);

// 3의배수, 4의배수 둘다 담고 싶다면 (조건문)
let resultFilter2 = arrFilter.filter(num => {
    if( num % 3 === 0 || num % 4 === 0 ) {
        return true;
    }else {
        return false;
    }
});

// ---------------------

// some()
// 배열의 모든 요소에 대해 콜백함수를 반복 실행하고,
// 조건에 만족하는 결과가 하나라도 있으면 true,
// 만족하는 결과가 하나도 없으면 false를 리턴

// 일회성으로 사용할 시
let arrSome = [1,2,3,4,5];
let resultSome = arrSome.some(num => num === 5);
console.log(resultSome);   // true 출력

// 여러번 사용할시 함수선언후 함수 넣기
// let resultSome = arrSome.some(someTest);
// console.log(resultSome);
// function someTest(num) {
//     return num === 6;
// }

// ---------------------

// every()
// 배열의 모든 요소에 대해 콜백함수를 반복 실행하고,
// 조건에 모든 결과가 만족하면 true,
// 하나라도 만족하지 않으면 false
let arrEvery = [1,2,3,4,5];
let resultEvery = arrEvery.every(num => num === 5);
console.log(resultEvery);   // false 출력

// ---------------------

// foreach()
// 배열의 모든 요소에 대해 콜백함수를 반복 실행
// php foreach랑 같음
let arrForeach = [1,2,3,4,5];
arrForeach.forEach((val, idx) => {
    // console.log(idx + ':' + val);
    console.log(`${idx} : ${val}`);
    // ``을 이용해 +없이 연결연산자 그리고 변수를 쓸때는 ${}을 적어준다.
});

// 이것말고도 배열객체들이 많다..
// every,some,filter,push,pop를 자주쓴다
