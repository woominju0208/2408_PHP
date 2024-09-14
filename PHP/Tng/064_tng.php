<?php
// 로또 번호 생성기
// 1. 1 ~ 45 번호가 있다.
// 2. 랜덤한 번호 6개를 출력한다.
// 2-1 단, 번호는 중복되지 않는다.



for($cnt= 1; $cnt <=6; $cnt++) {
    if($num = random_int(1,45)) 
    $num1 = random_int(1,45);
    // $random_num = $num;
    if($num === $num1) {
        continue;
    }
    // echo $num[$random_num]."\n";
    echo $num."\n";
}

echo "\n";


// // $num1 = 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,28,29,30,31,32,33,34,35,36,37,38,39,40,41,43,44,45
// for($cnt= 1; $cnt <=6; $cnt++) {
//     if($num = random_int(1,45)) {
//         echo $num."\n";

//         if($num === $num1) {
//             continue;
//         }
//     }
// }

// ----------------------------------------
// php 내장함수를 적극적으로 활용한 코드 
// ----------------------------------------

$arr = range(1,45);      // 1~45의 수를 가지는 배열
$get_numbers = [];       // 뽑은 숫자 저장용 배열

$random_key = array_rand($arr, 6);      // 배열에서 랜덤한 키(6개) 획득

foreach($random_key as $val) {
    $get_numbers[] = $arr[$val];         // 키를 이용해서 값 삽입
}

echo implode(" ", $get_numbers);    // 공백을 구분자로 배열을 스트링으로 출력