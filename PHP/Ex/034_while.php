<?php
// while문 : 조건을 체크하고 그 결과에 따라 처리를 진행하는 반복문
// break문 이나 증강연산자를 넣어서 조건을 넣지 않으면 무한반복이 되어 필수로 넣어준다.

$cnt = 0;

while($cnt <= 3) {
    echo $cnt."번째 루프"."\n";
    $cnt++;
}  //0,1,2,3

$cnt = 0;

while($cnt <= 3) {
    $cnt++;
    echo $cnt."번째 루프"."\n";
}  //1,2,3,4


// while 구구단
// $dan = 1;
// while($dan <=9) {
//     echo "2 x ".$dan. " = ".(2*$dan)."\n";
//     $dan++;
// }
