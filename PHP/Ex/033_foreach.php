<?php
// foreach 문 : 배열(array)을 편하게 루프하기 위한 반복문
// php에서 for문보다 foreach문을 더 많이 쓴다. 자주 많이 볼것이다.(배열을 더 많이 사용) 
$arr = [1, 2, 3, 4, 5];
foreach($arr as $key => $val) {
    echo "key : ".$key.", value : ".$val."\n";
}

$arr5 =["a","b","c","d",100];
foreach($arr5 as $key => $val) {
    echo "key : ".$key." val : ".$val."\n";
}
// $key 랑 $val의 변수이름은 다른걸 지어도 된다.($key는 배열의 방번호 key를 나타내는 거라 $key로 고정하는게 적기 좋다.)

// 아래 arr2를 이용해서 구구단 2단을 찍어주세요.
$arr2 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
foreach($arr2 as $key => $val ) {
    echo "2 x ".$val." = ".($val*2)."\n";
}

$arr2 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
foreach($arr2 as $val) {                   //$key => 생략 가능($key값을 안쓸시)
    echo "2 x ".$val." = ".($val*2)."\n";
}
// $key값과 $val값을 지정했을때 $key생략가능

// ----------------------------------------------------
// 연관배열(key값을 내가 정해주는 배열)의 겨우
$arr3 = [
    "name" => "meerkat"
    ,"age" => 20
    ,"gender" => "M"
];
foreach($arr3 as $key => $val) {
    echo $key. " : ".$val. "\n";
}
// 인덱스배열과 차이는 key에 따로 이름을 줬냐 안줬냐 차이

// ----------------------------------------------------
// $arr = [1, 2, 3, 4, 5];
// foreach($arr as $key => $val) {
//     echo "key : ".$key.", value : ".$val."\n";
// }

// for를 사용해서 배열을 반복하는 경우(너무 어렵 배열은 foreach를 쓰자)
$maxIndex = count($arr) -1;
for($i = 0; $i <= $maxIndex; $i++) {
    echo "key : ".$i.", value : ".$arr[$i]."\n";
}

echo "----------------------\n";

$result = [
    ["id" => 1, "name" => "미어캣", "gender" => "M" ]
    ,["id" => 2, "name" => "홍길동", "gender" => "M" ]
    ,["id" => 3, "name" => "갑순이", "gender" => "F" ]
];

foreach($result as $key => $item) {
    if($item["name"] === "갑순이") {
        echo $item["name"]."\n";
    }
}