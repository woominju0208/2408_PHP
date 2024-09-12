<?php

// 함수(function)
// 코드의 중복을 막기위한 프로그램

// 두 수를 전달해주면 합을 반환해주는 함수
// 함수정의

/**
 * 두 수를 더해서 반환
 * (이런식으로 내가 만든 함수 위에 코멘트)
 * 
 * @param int $num1: 숫자 (@param은 보통 생략)
 */
function my_sum($num1, $num2) {
    return $num1 + $num2;
}
my_sum(3, 5); // 함수호출

// parameter(매개변수) : 함수를 정의할때 외부에 값을 저장해두는것 ($num1, $num2이 해당)
// argument(인수) : 함수를 호출할때 전달해주는 값


// parameter가 없는경우 와부값이 아닌 time() 경우
// function time() {
//     return   ;
// }
// time();

// 두수를 받아서 -,*,/,%의 결과를 리턴하는 함수를 만들어 주세요.
function sub($num1, $num2) {
    return $num1 - $num2;
}
echo sub(5,3);

echo "\n";

function multi($num1, $num2) {
    return $num1 * $num2;
}
echo multi(3, 5);

echo "\n";

function div($num1, $num2) {
    return $num1 / $num2;
}
echo div(3, 5);

echo "\n";

function remain($num1, $num2) {
    return $num1 % $num2;
}
echo remain(3, 5);

echo "\n";

echo "-----------------------------\n";
// -----------------------------------
// 가변 길이 아규먼트

// 전달되는 모든 숫자를 더해서 반환
// ... 을 이용하는 방법 (** 주의 : php 5.6 이상에서 사용가능)
function my_sum_all(...$numbers) {
    // $sum = 0;
    
    // foreach($numbers as $val) {
    //     $sum += $val;
    // }
    return array_sum($numbers);
}
echo my_sum_all(4,5,8,2,3,1);

// $numbers 의 데이터타입은 arry(배열)
// ...$number 은 my_sum_all 안에 모든 값을 가져온다 라는 뜻
// my_sum_all(4,5,8,2,3,1);은 결국 my_sum_all=[4,5,8,2,3,1]; 라는 것
// my_sum_all의 배열이름을 $numbers


// 5.5버전 이하일때 가변 길이 아규먼트 사용법
function my_sum_all() {
    $numbers = func_get_args();
   
    $sum = 0;
    
    foreach($numbers as $val) {
        $sum += $val;
    }

    return $sum;
}
echo my_sum_all(4,5,8,2,3,1);

function my_sum_all() {
    $numbers = func_get_args();
    return array_sum($numbers);
}
echo my_sum_all(4,5,8,2,3,1);


// 일반 파라미터와 가변 파라미터를 같이 쓸 경우
function test($param_str, ...$arr_str) {
    $str = "";
    foreach($arr_str as $val) {
        $str .= $val;
    }
    $str .= $param_str;
    echo $str;
}
test("젤뒤", "a", "b", "c");