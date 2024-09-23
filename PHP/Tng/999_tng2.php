<?php

// 가위 바위 보 게임
// 게임 실행시, "가위", "바위", "보" 중 하나를 입력
// 컴퓨터는 랜덤으로 "가위", "바위", "보" 중 하나를 출력
// 결과를 출력
//      유저 : 가위
//      컴퓨터: 바위
//      졌습니다. or 이겼습니다.
fscanf(STDIN, "%s\n", $input);

echo "유저 : ".$input."\n";

$arr = ["Rock", "Paper", "Scissors"];
// $computer - array_rand($arr); 
$computer = $arr[random_int(0,2)];
// $arr 안에 배열의 키값 0,1,2를 랜덤으로 가져온다.
echo "컴퓨터 : ".$computer."\n";

    if($input === $computer) {
        echo "비겼습니다.";
    } else if (($input === "Rock" && $computer === "Scissors") || ($input === "Paper" && $computer === "Rock") || ($input === "Scissors" && $computer === "Paper")) {
        echo "이겼습니다.";
    }  else {
        echo "졌습니다.";
    }

    // // if,switch문 사용
    // if($input === "Rock") {
    //     switch($computer) {
    //         case "Rock";
    //         echo "비겼습니다.";
    //         break;
    //         case "Paper";
    //         echo "졌습니다.";
    //         break;
    //         case "Scissors";
    //         echo "이겼습니다.";
    //         break;
    //     }
    // } else if($input === "Paper") {
    //     switch($computer) {
    //         case "Rock";
    //         echo "이겼습니다.";
    //         break;
    //         case "Paper";
    //         echo "비겼습니다.";
    //         break;
    //         case "Scissors";
    //         echo "졌습니다.";
    //         break;
    //     }
    // } else if($input === "Scissors") {
    //     switch($computer) {
    //         case "Rock";
    //         echo "졌습니다.";
    //         break;
    //         case "Paper";
    //         echo "이겼습니다.";
    //         break;
    //         case "Scissors";
    //         echo "비겼습니다.";
    //         break;
    //     }
    // }

 