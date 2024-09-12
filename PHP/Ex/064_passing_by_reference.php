<?php
// 값복사(Value Of copy)    : 데이터 int, double, string, boolean, null, array
$num1 = 100;
$num2 = $num1 ;   

$num2 -= 50;    // $num2 에 -50을 한것

echo $num1,$num2;  // num1 = 100, num2 = 50


// 참조전달(Passing By Reference)   : 데이터 object
$num3 = 100;
$num4 = &$num3 ;   //참조전달(&)

$num4 -= 50;    // $num2 에 -50을 한것

echo $num3,$num4;  // num1 = 50, num2 = 50

echo "---------------------------------\n";
// class 를 사용하면 참조전달

function my_test(&$num) {
    $num--;
}

$num5 = 5;
my_test($num5);
echo $num5;


// ---------------------------------------------
// 스코프 : 변수나 함수의 유효 범위
// ---------------------------------------------

// 전역 스코프
// <?php 입력후 바로 아래 변수
$str = "전역 스코프";
function my_scope1() {
    global $str;    //전역스코프 사용을 위해 선언
    echo $str;
}
my_scope1();
// 함수 안 변수는 지역 스코프
echo "\n------------------\n";

// 지역 스코크 : 적용한 함수 안에서만 사용 가능함 (함수를 사용하면 그 안에 있는 변수값도 사라진다.)
// 지역 스코프 : 클래스, 메소드, 함수
function my_scope2() {
    $str2 = "my_scope2 영역";
    echo $str2;
}   
my_scope2();

echo "\n------------------\n";

for($i = 1; $i < 6; $i++) {
    $str3 = "포문";
}
echo $str3;


echo "\n------------------\n";

function my_scpoe5() {
    $test = 5;
    echo $test;
}
my_scpoe5();


// 정적 스코프