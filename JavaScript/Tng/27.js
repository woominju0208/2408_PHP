// 원본은 보존하면서 오름차순 정렬 해주세요.
// 배열을 복사하려면 [...배열이름] 을 하면 복사
// const ARR1 = [ 6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40 ];
// const COPY_ARR1 = [...ARR1];
// let resultSort = COPY_ARR1.sort((a, b) => a - b );
// console.log(resultSort);
// console.log(ARR1);

// const COPY_ARR1 = ARR1; 은 값 복사가 아니라 주소값을 복사해 숫자를 바꾸면 같이 바뀜
const ARR1 = [ 6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40 ];
const COPY_ARR1 = [...ARR1];
let resultSort1 = COPY_ARR1.filter((val, index) => {
    return COPY_ARR1.indexOf(val) === index;
});
let resultSort2 = resultSort1.sort((a, b) => a - b );
console.log(resultSort2);

// 1. forEach(), includes() 이용 
let duplicationArr = [];
COPY_ARR1.forEach(val => {
    if(!duplicationArr.includes(val)) {
        duplicationArr.push(val);
        // 빈배열에 값이 들어가는데 값이 없으면 push들어가고 이미있는 값이 있으면 push하지 않는다.
    }
});
console.log(duplicationArr);


// 2.filter(), indexOf() 이용
let duplicationArr2 = COPY_ARR1.filter((val, idx) => {
    return COPY_ARR1.indexOf(val) === idx;
    // indexOf는 첫번째 idx를 가져온다.
    // 배열 6이 들어갈때 idx 0 으로 indexOf(val) 은 0 idx는 0 으로 0 === 0;으로 값이 들어간다. 
});
console.log(duplicationArr2);


// 3. Set 객체
// set이란 중복한 값을 없이 출력하는 자료구조론  Set 객체로 변환 => 다시 Array 객체로 변화
let duplicationArr3 = Array.from(new Set(COPY_ARR1));
console.log(duplicationArr3);






// 짝수와 홀수를 분리해서 각각 새로운 배열 만들어 주세요.
const ARR2 = [5,7,3,4,5,1,2];

let resultOdd = ARR2.filter(num => num % 2 === 1);
console.log(resultOdd);
// let resultOddUp = resultOdd.sort((a,b) => a - b);
// console.log(resultOddUp);
let resultEven = ARR2.filter(num => num % 2 === 0);
console.log(resultEven);


const ODD = ARR2.filter(num => num % 2 !== 0);
const EVEN = ARR2.filter(num => num % 2 === 0);
console.log(ODD);
console.log(EVEN);


// forEach 반복문써서 한번에 홀수,짝수 나타내기
const ODD2 = [];
const EVEN2 = [];

ARR2.forEach(val => {
    if(val % 2 === 0) {
        if(!EVEN2.includes(val)) {
            EVEN2.push(val);
        }
    } else {
        if(!ODD2.includes(val)) {
            ODD2.push(val);
        }
    }
});

// if(!EVEN2.includes(val)) 과 if(!ODD2.includes(val))는 그 값이 없을경우에 값을 넣겠다
// 조건을 주어 중복값이 들어갈수 없게 만들었다.



 