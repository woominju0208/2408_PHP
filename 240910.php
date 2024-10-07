<?php
// define("AGE", 20);
// echo AGE."\n";


// $num = 10_000_000;
// echo $num."\n";

// $num1 = 200;
// $num2 = 10;
// $tmp;
// $tmp = $num1;
// $num1 = $num2;
// $num2 = $tmp;
// echo $num1, $num2;





$arr = [4, 3, 6, 1];

// 배열에서 특정 요소 접근
echo $arr[0]."\n";
echo $arr[1]."\n";
echo $arr[2]."\n";
echo $arr[3]."\n";

$arr[2] = 100;
var_dump($arr);
echo "\n";
$arr[0] = "안녕하세요.";
var_dump($arr);

// 1등이면 금상, 2등이면 은상, 3등이면 동상, 4등이면 장려상, 그 외는 노력상
// 을 출력해 주세요.


$rank =10;
if(gettype($rank) === "integer") {
    if($rank === 1) {
        echo "금상";
    } else if($rank === 2) {
        echo "은상";
    } else if($rank === 3) {
        echo "동상";
    } else if($rank === 4) {
        echo "장려상";
    } else {
        echo "노력상";
    }
}
echo "\n";


$int = 0;
$int++;
echo $int;
echo $int;
$int++;
$int++;
$int++;
echo $int++;
echo $int."\n";

$int = 0;
++$int;
echo $int;
echo ++$int;

echo "--------------------------------\n";
// 삼각형
for($i = 1; $i <= 5; $i++) {
    for($z=0; $z<$i; $z++) {
        echo "*";
    }
    echo "\n";
}
echo "--------------------------------\n";
// 역삼각형
for($i = 5; $i >= 1; $i--) {
    for($z = 0; $z<$i; $z++) {
        echo "*";
    }
    echo "\n";
}
echo "--------------------------------\n";
// 홀수값
for($i = 1; $i <=6; $i++) {
    if(($i%2) === 1) {
        echo $i."\n";
    }
}
echo "--------------------------------\n";
// 짝수값
for($i = 1; $i <= 6; $i++) {
    if(($i%2) === 0){
        echo $i."\n";
    }
}
echo "--------------------------------\n";
// 배열값 구하기(if조건 사용)  (질문) 2000-01-01 에 - 가 들어가면 ""로 문자열 표시 해야하는거 아닌가?? 숫자열로 놔두고 비교연산잘로 구했을 때 값의 조건으로 인식
//                           (정답) "200-01-01"로 적는게 맞다! - 가 들어가면 문자열이기 때문에 php자체에 이상하게 인식되어서 적용된것이다 ""없이 적는건 틀린것
$arr =[
    ["id" => 1, "name" => "미어캣", "gender" => "M", "birth" => "2000-01-01" ]
    ,["id" => 2, "name" => "홍길동", "gender" => "M", "birth" => "2002-01-01" ]
    ,["id" => 3, "name" => "갑순이", "gender" => "F", "birth" => "2005-01-01" ]
    ,["id" => 4, "name" => "농담곰", "gender" => "F", "birth" => "2010-01-01"]
];

foreach($arr as $key => $item) {
    if($item["gender"] === "F" && $item["id"] >= 4 && $item["birth"] > "2000-01-01" )
    echo "값 : ".$item["name"]."\n";
}



echo "--------------------------------\n";

// 5.5버전 이하일때 가변 길이 아규먼트 사용법(내장함수 사용 array_sum)
// function my_sum_all() {
//     $numbers = func_get_args();
//     return array_sum($numbers);
// }
// echo my_sum_all(4,5,8,2,3,1);



function test($param_str, ...$arr_str) {
    $str = "";
    foreach($arr_str as $val) {
        $str.=$val;
    }
    $str .= $param_str;
    echo $str;
}
test("젤뒤", "a", "b", "c");

echo "-----------------------\n"; 

$num_sel = random_int(1,45);
for($num= 1; $num <=6; $num++) {
    if($num_sel) {
        echo "번호: ".$num_sel."\n";         //echo "번호: ".random_int(1,45)                          
    }
    if(($num_sel=$num_sel)) {
        continue;
    }
    echo "\n";
}

// $num_sel = random_int(1,45);
// $arr = [1,2,3,4,5,6,7,8,9,10];
// foreach($arr as $key => $item) {
//     for($num= 1; $num <=6; $num++) {
//         if() {
//             echo "번호: ".$num_sel."\n";
//         }
//     }

// }

// for($cnt= 1; $cnt <=6; $cnt++) {
//     $num = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
//     $random_num = array_rand($num);
//     if(($num%$random_num) === 0) {
//         continue;
//     }
//     echo $num[$random_num]."\n";
     
// }
$num1 = random_int(1,45);

for($cnt= 1; $cnt <=6; $cnt++) {
    $num = random_int(1,45);
    $num1 = random_int(1,45);
    // $random_num = $num;
    if($num === $num1) {
        continue;
    }
    // echo $num[$random_num]."\n";
    echo $num;
}


echo "\n-----------------------\n"; 

function remain1($num1, $num2) {
    return $num1 * $num2;
}
echo remain1(3,5);

echo "\n-----------------------\n"; 
function remain() {
    $num1 = 3;
    $num2 = 3;
    return $num1 * $num2;
}
echo remain();

echo "\n-----------------------\n"; 

function my_scpoe5() {
    $test = 5;
    echo $test;
}
my_scpoe5();  // 함수my_scpoe5()을 호출한다는 의미 출력은x , 함수안에 echo문을 넣었기 때문에 5가 출력이 되었다.

echo "\n-----------------------\n"; 

$str6 = "점심 뭐먹지?";
echo mb_strpos($str6, "뭐")."\n";


// 문자열중 특정부분에서 원하는 부분까지 출력 (mb_strpos로 특정위치를 구한다음 mb_substr로 원하는 부분까지 출력)
$str7 = "안녕하세요.농담곰입니다.";
echo mb_substr($str7, mb_strpos($str7, "농"), 5)."\n";
echo mb_strpos($str7, "농")."\n";

$str_format = "축하합니다! 당신은 %.1f점으로 %s 등급을 받으셨습니다.";
$str_format1 = "아쉽습니다.. 당신은 %d점으로 %s 등급을 받으셨습니다.";
echo sprintf($str_format, 90.8, "S");
echo "\n-----------------------\n"; 
echo sprintf($str_format1, 10, "F");

echo "\n-----------------------\n"; 

$type4 = [1,2,3,4,5];
if(gettype($type4) === "array") {
    echo "배열임.\n";
}
echo implode("\n",$type4);

(string)$type4;
var_dump($type4);

if(gettype($type4) === "string") {
    echo "문자임.\n";
}

