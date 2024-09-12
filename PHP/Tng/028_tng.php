<?php

// 1. 3의 배수 게임 (100)
// 출력 예) 1, 2, 짝, 4, 5, 짝, 7, 8, 짝, 10 ...

// for($num = 1; $num <= 100; $num++) {
//     for($num1 = 1; $num === ($num1*3); $num1++) {
//         echo "짝\n";
//     }
//     echo $num."\n";
// }

echo "-------------------------\n";
for($i = 1; $i <= 100; $i++) {
    if(($i%3) === 0) {
        echo "짝\n";
        continue;
    }           
    echo $i."\n"; 
}

// continue; 가 아닌 else 로 쓰기
for($i = 1; $i <= 100; $i++) {
    if(($i%3) === 0) {
        echo "짝\n";
    } else {
        echo $i;
    }        
    if($i !== 100) {
        echo ",";
    }
}


// continue를 적지 않으면 3의배수에서 짝이 나오고 밑에 echo $i."\n";로 인해 짝 과 3의배수 값까지 같이 나온다.
// continue : 처리중에 continue가 나오면 그이후의 처리는 건너뛰고 다음 루프 진행

// 2. 반복문을 이용하여 급여가 5000이상이고, 성별이 남자인 사원의 id와 이름을 출력해주세요.
//  출력 예)
//          id : 1, name : 미어캣
//          id : 2, name : 홍길동
//          ...
$arr = [
    ["id" => 1, "name" => "미어캣", "gender" => "M", "salary" => "6000"]
    ,["id" => 2, "name" => "홍길동", "gender" => "M", "salary" => "3000"]
    ,["id" => 3, "name" => "갑순이", "gender" => "F", "salary" => "10000"]
    ,["id" => 4, "name" => "갑돌이", "gender" => "M", "salary" => "8000"]
];

// foreach($arr as $item) {
//     if($item["salary"] >= "5000") {
//         echo $item["id"],$item["name"]."\n";
//     }
// }
// $item["gender"] === "M"


foreach($arr as $item) {
    if(((int)$item["salary"] >= "5000") && ($item["gender"] === "M")) {
        echo "id:".$item["id"]," name:".$item["name"]."\n";
    }
}
// (int)를 넣음으로써 데이터타입을 명확하게 인식
