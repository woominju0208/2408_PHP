// -------------
// 함수 선언식
// 호이스팅에 영향을 받는다.
// 재할당 가능하므로 함수명 중복 안되게 조심해야 함 (함수명만 중복안되게!!!)
// -------------
// 함수 쓰는 이유 : 유지보수를 쉽게 하기 위해(모듈화하면 편하다.)
// 문제: 함수가 뭘까요???? 특정값을 넣으면 계산식을 통해 결과값을 도출
console.log(mySum(4, 5));


function mySum(a, b) {
    return a + b;
}

// console.log(testMySum(4, 5, 10));
// function testMySum(a, b, c) {
//     return a + b + c;
// }


// -------------
// 함수 표현식
// 호이스팅에 영향을 받지 않는다.
// 무조건 위에 선언을 하고 사용 할 수있다.
// 재할당을 방지
// console.log없이 console에 myPlus(1,2); 이런식으로 치면 값이 나옴
// -------------

// console.log(myPlus(4, 5));
// 이런식으로 위에 호출을 할때는 찾을수 없다. const,let 

const myPlus = function(a, b) {  // 익명함수
    return a + b;
}

// -------------
// 화살표 함수(현업에서 사용)
// -------------
// 파라미터 2개 이상일 경우 (소괄호 생략 불가)
const arrowFnc = (a, b) => a + b;
// 위와 아래가 같은 형태
function test1(a,b) {
    return a + b;
}

// 파라미터가 1개일 경우 (소괄호 생략 가능)
const arrowFnc2 = a => a;
function test1(a) {
    return a;
}

// 파라미터가 없는 경우 (소괄호 생략 불가)
const arrowFnc3 = () => 'test';
function test1() {
    return 'test';
}

// 처리가 여러줄일 경우
const arrowFnc4 = (a, b) => {
    if(a < b) {
        return 'b가 더큼';
    } else {
        return 'a가 더큼'; 
    }
}
function test4(a,b) {
    if(a < b) {
        return 'b가 더큼';
    } else {
        return 'a가 더큼'; 
    }
}


// 이런식으로 object안에 함수도 넣을수 있다.(그래서 화살표 함수 사용)
const OBJ1 = {
    key1 : 1
    ,mySum: (a, b) => a + b
}

OBJ1.mySum(1,2);

// 자바스크립트는 함수안에 함수를 적을수 있다.
// 함수안에 함수를 선언할순 있지만 호출을 할순없다.
// 부모객체 안에선 함수를 사용할수 있지만 {} 밖을 나가면 사용할수 x



// ----------------------
// 즉시실행 함수
// ----------------------
// 함수를 정의하는것과 동시에 실행도 함
// 단 한번만 호출함
// 요즘은 새로 만들지 않고 만들어진걸 가져오기만 해서 잘 사용하진 않는다.
const execFnc = (function(a,b) {
    return a + b;
})(5,10);
// console에 execFnc 인 함수이름만 적으면 출력


// ----------------------
// 콜백 함수(자주 씀)
// ----------------------
// 다른 함수의 파라미터로 전달되어 특정 조건에 따라 호출되는 함수
// 많은곳에 쓰이고 유지보수를 쉽게 하기 위해 모듈화를 함
function myCallBack() {
    console.log('myCallBack');
}

function myChkPrint(callBack, flg) {
    if(flg) {
        callBack();
    }
}

myChkPrint(myCallBack,true);     // myCallBack
myChkPrint(myCallBack,false);     // undefined

// 이런식으로 위에 함수선언을 따로안하고 함수안에 함수를 일회성으로 만들기도 한다.
myChkPrint(() => 'ttt', true);