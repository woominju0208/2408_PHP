<?php

$food = "";

// if($food === "떡볶이") {
//     echo "한식";
// } else if($food === "짜장면") {
//     echo "중식";
// } else if ($food === "햄버거") {
//     echo "양식";
// // }
// echo "\n";

// switch 문
// 1 : 1 로 매칭되는걸 검증할 때만 사용(gender같이 성별 2가지 일때)
// 범위와 관련된 조건문을 쓸땐 if문을 쓰는게 좋다(비교연산자 , 논리연산자를  switch로 쓸순 있지만 지양)
// 여러개의 조건(case)을 넣고 싶을시 case를 여러개 써준다.(비교연산자,논리연산자 사용x) 
switch($food) {
    case "떡볶이":
        echo "한식";
        break;    // break 생략시 그다음 처리도 계속 이어가서 break문 필수
    case "짜장면":
    case "짬뽕":
        echo "중식";
        break;
    case "햄버거":
        echo "양식";
        break;
    default:
    echo "맛있음"."\n";
        break;
} 



// switch를 이용하여 작성
// 1등이면 금상, 2등이면 은상. 3등이면 동상, 4등이면 장려상, 그외에는 노력상 출력
$rank = 2;

switch($rank) {
    case 1:
        echo "금상";
        break;
    case 2:
        echo "은상";
        break;
    case 3:
        echo "동상";
        break;
    case 4:
        echo "장려상";
        break;
    default:
        echo "노력상";
        break;
    }

// if문으로 쓰자 (비교 연산자 사용으로 지양)
// switch(true) { case ~ : switch() {} }
$rank = "4등";
switch(true) {
    case gettype($rank) === "string":
    switch($rank) {
        case "1등":
            echo "금상";
            break;
        case "2등":
            echo "은상";
            break;
        case "3등":
            echo "동상";
            break;
        case "4등":
            echo "장려상";
            break;
        default:
            echo "노력상";
            break;
    }
}
