// ---------------------
// 배열
// 자바스크립트에서 배열은 객체
// php에선 key의 순서가 없었지만 자바스크립트,자바등은 key의 순서가 있다.
// ---------------------
const ARR1 = [1, 2, 3, 4, 5];
// ARR1 = [0] 입력시 1 출력

// push()
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length
ARR1.push(10);
// php 에선 ->였지만 자바스크립트는 '.' 이 붙는다.

// length
// 배열의 길이 획득
// 메소드가 아니고 프로퍼티이기 때문에 ()적지 않음
console.log(ARR1.length);

// isArray()
// 배열인지 아닌지 체크 해주는 메소드
console.log(Array.isArray(ARR1));  // true
console.log(Array.isArray(1));  // false