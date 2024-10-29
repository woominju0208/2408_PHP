// ---------------
// String 객체
// 문자열도 객체
// ---------------
let str = '문자열입니다.문자열입니다.';
let str2 = new String('문자열입니다.');

// literable property의 특징은 length를 가지고 있다.
// length : 문자열의 길이를 반환 (property)
console.log(str.length);

// charAt(idx) : 해당 인덱스의 문자를 반환 (method)
console.log(str.charAt(2)); // 열 출력
console.log(str.charAt()); // 문 출력

// indexOf() : 문자열에서 해당 문자열을 찾아 최초의 인덱스를 반환
// 해당 문자열이 없으면 -1 리턴
console.log(str.indexOf('자열'));       // 1 출력
console.log(str.indexOf('자열', 5));    // 8 출력
// 인덱스 5 부터 시작해서 앞에 문자를 찾아 인덱스를 출력한다.

// includes() : 문자열에서 해당 문자열의 존재여부 체크
console.log(str.includes('문자'));  // true 출력
console.log(str.includes('만두'));  // false 출력

let test = 'i am manduking';
test.includes('ki');    // true

// replace() : 특정 문자열을 찾아서 지정한 문자열로 치환한 문자열을 반환, 원본변환x
// 가장 첫번째 문자열만 바꿔준다.
// 정규식을 통해 특정 패턴이 있는 부분만 바꿀수도 있음
str = '문자열입니다.문자열입니다.';
console.log(str.replace('문자열', '만두')); // 만두입니다.문자열입니다. 출력

// replaceAll() : 특정문자열을 찾아서 모두 지정한 문자열로 치환한 문자열을 반환, 원본변환x
// 모든 문자열을 바꿔준다.
console.log(str.replaceAll('문자열', '만두'));  // 만두입니다.만두입니다. 출력

// 빈 문자열로 넣으면 없이 해당 문자열을 지울수 있다.
console.log(str.replaceAll('문자열', ''));  // 입니다.입니다. 출력

// substring(start, end) : 시작 인덱스부터 종료 인덱스까지 자른 문자열을 반환
// endIndex는 생략시 startIndex부터 끝까지의 문자열 반환
//  ** 주의 : 비슷한 기능으로 String.substr()이 있으나 비표준이므로 사용을 지양할 것 **
str = '문자열입니다.문자열입니다.';
console.log(str.substring(1, 3));   // 자열 출력

// 예시
str = 'bearer: 22434ajdnjndjdnsjasdnj23jn24ja'
console.log(str.substring(8)); // 22434ajdnjndjdnsjasdnj23jn24ja 출력
// end값을 안적어주면 statr부터 끝까지 출력한다.


// split(separator, limit) : 문자열을 separator 기준으로 잘라서 배열을 만들어 반환
// PHP explode와 같음(문자열을 배열로)
// limit는 배열의 길이를 제한하는 숫자
str = '짜장면,탕수육,라조기,짬뽕,볶음밥';
let arrSplit = str.split(',');
let arrSplit2 = str.split(',', 2);  // 배열의 길이를 2로 제한
console.log(arrSplit);
console.log(arrSplit2);

// trim() : 좌우 공백 제거 (자주씀)
str = '       문자열 입니다.    ';
console.log(str.trim());

// toUpperCase(), toLowerCase() : 알파벳을 대/소문자로 변환해서 반환
str = 'aBcDEfg'
console.log(str.toUpperCase());     // ABCDEFG
console.log(str.toLowerCase());     // abcdefg

// 다른 문자열 객체 관련 메소드도 많기 때문에 참고