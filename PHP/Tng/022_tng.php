<?php
// IF로 만들어주세요.
// 성적
// 범위 :
//      100   : A+
//      90이상 100미만 : A
//      80이상 90미만 : B
//      70이상 80미만 : C
//      60이상 70미만 : D
//      60미만: F
// 출력 문구 : "당신의 점수는 XXX점 입니다. <등급>"


$score = 50;
if($score === 100) {                         //$score = 100 은 $score 값이 100이라고 지정된거라 위에 $score값을 바꿔도 100으로 고정되어서 A+점수만 나온것이다.
    echo "당신의 점수는 A+점 입니다.\n";
} else if ($score >= 90 && $score < 100) {
    echo "당신의 점수는 A점 입니다.\n";
} else if ( $score >= 80 && $score < 90) {
    echo "당신의 점수는 B점 입니다.\n";
} else if ($score >=70 && $score < 80) {
    echo "당신의 점수는 C점 입니다.\n";
} else if ($score >= 60 && $score < 70) {
    echo "당신의 점수는 D점 입니다.\n";
} else if ($score < 60) {
    echo "당신의 점수는 F점 입니다.\n";
}

$score = 90;
$rank = "";

if($score === 100) {
    $rank = "A+";
} else if($score >= 90 && $score < 100) {
    $rank = "A";
} else if($score >= 80 && $score < 90) {
    $rank = "B";
} else if($score >= 70 && $score < 80) {
    $rank = "C";
} else if($score >= 60 && $score < 70) {
    $rank = "D";
} else if($score < 60) {
    $rank = "F";
}
echo "출력 문구 : 당신의 점수는 ".$score."점 입니다. <$rank>";

$score = 100;
$rank = "";

echo "\n";

if($score >=0 && $score <= 100) {
    if($score === 100) {
        $rank = "A+";
    } else if($score >= 90) {
        $rank = "A";
    } else if($score >= 80) {
        $rank = "B";
    } else if($score >= 70) {
        $rank = "C";
    } else if($score >= 60) {
        $rank = "D";
    } else if($score < 60) {
        $rank = "F";
    }
    echo "출력 문구 : 당신의 점수는 ".$score."점 입니다. <$rank>";
}
// 위에 조건에서 점수가 걸러지기 때문에 && 미만 숫자를 적을 필요가 없다.
// echo 문도 if문 조건 안에 넣어져야지 조건에 맞게 처리가 된다.
echo "\n";
echo "안녕하세요".$score."입니다.<$rank>";
echo "\n";
echo $score.$rank."안녕하세요.".$rank.$score."점 입니다.";





