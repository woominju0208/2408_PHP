console.log('외부파일');
// 자바스크립트는 카멜기법

// ------ 변수 ------
// let이랑 const쓰자!!!!!!(var 쓰기 x)
// var : 중복 선언 가능, 재할당 가능, 함수레벨 스코프
//  프로젝트 시에는 var사용을 지양하고 let과 const를 쓴다.
var num1 = 1;  // 최초 선언
var num1 = 2;  // 중복 선언
num1 = 3;  // 재할당 , 앞에 선언이 없으면 var가 default 

// let : 중복 선언 불가능, 재할당 가능, 블록레벨 스코프
let num2 = 2;  // 최초 선언
// let num2 = 3;  // 중복 선언, 불가능
num2 = 4;  // 재할당

// php는 중복선언이 가능했지만 다른언어 java 같은 경우는 중복선언이 불가능하다.

// const : 중복 선언 불가능, 재할당 불가능, 블록레벨 스코프, 상수
const NUM3 = 3;
// NUM3 = 4;  // 재할당,불가능 (console에 오류)

// ----------------
// 스코프
// ----------------
// 변수나 함수가 유효한 범위
// 전역, 지역, 블록 3가지의 스코프

// 전역 레벨 스코프
let globalScope = '전역이다.';

function myPrint() {
    console.log(globalScope);
}

// 지역 레벨 스코프
// 함수의 내에서만 사용가능
// 함수레벨 스코프와 비슷하다.
function myLocalPrint() {
    let localScope = '마이로컬프린트 지역';
    let localScopeTest = '만두짱';
    console.log(localScope);
    console.log(localScopeTest);
}

// 블록 레벨 스코프
// {} 선언후 같은{}안이 아닌 밖에서 출력하면 나오지 않는다. 선언이 되지 않았다고 출력
function myBlock() {
    if(true) {
        var test1 = 'var';
        let test2 = 'let';
        const TEST3 = 'const';
    }
    console.log(test1);
    console.log(test2);
    console.log(TEST3);
}
// {}밖에 선언 되었기 때문에 var만 출력하고 let과 const는 출력되지 않는다.

// 퓨어 php는 쌍따옴표 ""
// 라라벨 다른 프로그램과 같이 사용시에는 홑따옴표 ''

// ----------------------------------------
// 호이스팅 : 인터프리터가 변수와 함수의 메모리 공간을 선언전 에 미리 할당하는 것(방을 미리 만들어 둠)
// ----------------------------------------
// console.log(test);
// test = 'aaa';
// console.log(test);
// // var test;
// let test;

// var를 사용시 오류가 나오지 않고 66번의 undefined만 나오고 test를 적으면 출력이 돼 버린다.
// 호이스팅이 선언을 함으로써 방은 만들었지만(변수 선언) let,const는 오류라는 부분을 보여준다.(66번 선언전이기 때문에 로그를 불러올수 없다.)

// --------------
// 데이터 타입
// --------------
// number : 숫자
let num = 1;

// string : 문자열
let str = 'test';

// boolean : 논리(true or false)
let bool = true;

// NULL : 존재하지 않는 값
let letNull = null;

// undefined : 값이 할당 되지 않은 상태
let letUndefined;

// symbol : 고유하고 변경이 불가능한 값(정말 거의 안쓴다.)
let symbol1 = Symbol('aaa');
let symbol2 = Symbol('aaa');
// 객체를 선언할때는 대문자로 선언
// php class는 객체를 만들기위한 것

// object : 객체, 키-값 쌍으로 이루어진 복합 데이터 타입(정말 자주 사용)
// 무조건 key(키)와 val(값)이 세트
let obj = {
    'key1' : 'val1'
    ,'key2' : 'val2'
    ,'key3' : 'mandu'
    ,'key4' : 12345
    ,'key5' : null
} ;

// key1 : 'val1' 이렇게 key에 ''를 안적어도 된다.
