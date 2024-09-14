<?php

// 변수 (Variable) 
// $변수명 = 변수; (변수명에 숫자든 문자든 다 들어감)
// 변수 선언

$dan = 6;
$wow = 1;

echo "$wow x 1 = 2\n";
echo "$dan x 2 = 4\n";
echo "$dan x 3 = 6\n";
echo "$dan x 4 = 8\n";
echo "$dan x 5 = 10\n";

echo $dan." x 2 = 4\n";

// 변수 선언
// 변수 선언은 가장 위에 위치를 하자
$num;

// 변수 초기화(변수 선언하고 값을 지정)
$num = 1;

// 변수 선언 및 초기화
$str = "가나다";

// 변수 명명 규칙
// 변수명은 영문 대소문자,숫자 언더바(_) 사용 가능 ('_'이외의 특수기호 사용 불가/한글은 사용 가능하나 지양 , 영어로 적자)
// 숫자로 시작이 불가능
// 변수명은 공백이 포함 불가
// 변수명은 미리 지정되어 있는 예약어 사용불가 ex)$this $_POST 등등
// 변수명은 대소문자 구분 ($Num 과 $num 은 서로 다른 인식)

// --------------------------------
// 변수 네이밍 기법
// 스네이크 기법
$user_name;
$user_name_pack;


// 카멜 기법(객체 지향 언어에 사용)
$userName;
$userNamePack;

// ---------------------------------
$name = "미어캣\n";
echo $name;
$name = "고양이\n";
echo $name;

// ---------------------------------
// 상수 (Constants)
// 상수특징 모두 대문자(상수는 기본적으로 모두 대문자 변수는 네이밍 기법 따라 소문자,소문자+대문자)
// 상수는 $ 생략
define("AGE", 20);
echo AGE;
// define("AGE", 30); // 이미 선언된 상수이므로 warning이 일어나고 값이 바뀌지 않는다. error는 실행되는게 아예 멈추고 warning는 경고부분만 멈추고 뒤엔 계속 실행된다.

// 리터럴(Literal)
// 그 자체로 의미를 가지고 변하지 않는 값
// define("AGE", 20); 에서 리터럴은 20

// underscore 표기법
$num = 10_000_000;
echo $num."\n";

// 아래처럼 변수 값을 담아서 출력해 주세요.
// 점심메뉴
// 탕수육 8,000
// 짜장면 6,000
// 짬뽕 6,000
$menu_lunch = "점심메뉴\n";
$menu1 = "탕수육 8,000\n";
$menu2 = "짜장면 6,000\n";
$menu3 = "짬뽕 6,000\n";

echo $menu_lunch, $menu1, $menu2, $menu3;

// 변수에 개행 echo $변수명."\n";

// ---------------------
// 두 변수의 스왑
$num1 = 200;
$num2 = 10;
$tmp;
$tmp = $num1;
$num1 = $num2;
$num2 = $tmp;
echo $num1, $num2;
//  = 은 오른쪽에 있는 값을 왼쪽에 대입 $num1 = $num2;  $num2 = 100; 이면 $num1 의 값은 100이 된다


// --------------------------------------
// 데이터 타입
// --------------------------------------
//int : 정수
$num = 1;
var_dump($num); 

// float, double : 실수
// double 이 float보다 소수점을 저장할수 있는 양이 많다
$double = 3.141592;
var_dump($double);

// string : 문자열
$str = "abc가나다";
var_dump($str);
$str = "abc가나다라마";
var_dump($str);

// boolean : 논리값
$boo = true;
var_dump($boo);
$boo = false;
var_dump($boo);

// NULL : 널
$null = null;
var_dump($null);

// array : 배열
$arr = [1,2,3];
var_dump($arr);

// object : 객체
$obj = new DateTime();
var_dump($obj);

// 형변환
$casting = (String)$num;
var_dump($casting);