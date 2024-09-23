<?php
fscanf(STDIN, "%s\n", $input);

echo "유저 : ".$input."\n";

$arr = ["Rock", "Paper", "Scissors"];
$computer = $arr[random_int(0,2)];
echo "컴퓨터 : ".$computer."\n";


if($input === "Rock") {
    switch($computer) {
        case "Rock":
            echo "비겼습니다.";
            break;
        case "Paper":
            echo "졌습니다.";
            break;
        case "Scissors":
            echo "이겼습니다.";
            break;
    }
} else if($input === "Paper") {
    switch($computer) {
        case "Rock":
            echo "이겼습니다.";
            break;
        case "Paper":
            echo "비겼습니다.";
            break;
        case "Scissors":
            echo "졌습니다.";
            break;
    }
} else if($input === "Scissors") {
    switch($computer) {
        case "Rock":
            echo "졌습니다.";
            break;
        case "Paper":
            echo "이겼습니다.";
            break;
        case "Scissors":
            echo "비겼습니다.";
            break;
    }
}