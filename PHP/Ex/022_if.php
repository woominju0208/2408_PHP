<?php

// -----------------------------
// if문 : 조건에 따라서 서로 다른 처리를 할 때 사용하는 문법
// if문 제일 끝에는 ;을 넣지 않는다.
// -----------------------------
$num = 10;
if($num === 10) {
    echo "10입니다\n";
} else if ($num === 5) {
    echo "5입니다\n";
} else if ($num === 7) {
    echo "럭키\n";
}
 else {
    echo "숫자입니다.\n";
}
/**
 * if(조건) {
 *  처리문;
 * } else if (조건) {
 *  처리문;
 * } else {
 *  처리문;
 * } */   

//  1이면 1등 , 2면 2등, 3이면 3등, 나머지는 순위 외, 5번만 특별상을 출력
$rank = 5;
    if($rank === 1) {
        echo "1등\n";
    } else if  ($rank === 2) {
        echo "2등\n";
    } else if  ($rank === 3) {
        echo "3등\n";
    } else if  ($rank === 4 || $rank === 5) {
        echo "특별상\n";
    } else {
        echo "순위 외\n";
    }

// else 순위 외가 숫자열만 적었을때 나왔으면 좋겠다 => 
// 문자열로 입력했을때도 순위외가 나오는데 if로 타입을 interger 숫자열로 지정해주고 if안 if 조건문을 적어 주면 숫자만 인식되서 if안 if조건문이 인식된다. 
// if(gettype($rank) === "integer") {
//     if($rank === 1) {
//         echo "1등\n";
//     } else if  ($rank === 2) {
//         echo "2등\n";
//     } else if  ($rank === 3) {
//         echo "3등\n";
//     } else if  ($rank === 5) {
//         echo "특별상\n";
//     } else {
//         echo "순위 외\n";
//     }
// }


// 조건은 논리연산자(and 연산자&&, or 연산자||, not 연산자!() )로 여러개 쓸수 있다.
$answer1 = 2;
$answer2 = 5;

if($answer1 === 2 && $answer2 === 5) {
    echo "100점\n";
} else if ($answer1 === 2 || $answer2 === 5) {
    echo "50점\n";
} else {
    echo "0점";
}
