<?php

// 동적쿼리 원리
$data = [
    "name" => "둘리"
    ,"gender" => "M"
    ,"birth" => "1986-01-01"
];

$sql = 
    " SELECT * "
    ." FROM employees "
;

$where = "";
// 빈 $where 생성
$arr_prepare = [];
// 빈 placeholder 생성


foreach($data as $key => $val) {
    if(empty($where)) {
        $where .= " WHERE ";
    } else {
        $where .= " AND ";
    }
    $where .= " ".$key." = :".$key;
    // sql injection 을 막기위해 $key." = :".$val; 을 적지않는다(그래서 prepare statment를 따로 작성해줘서 거기에 $val값을 넣어준다.)


    // prepare statment 작성
    $arr_prepare[$key] = $val;
}

$sql .= $where; 
// $sql .= $where; === $sql = $sql.$where;
echo $sql."\n";

print_r($arr_prepare);

// my_db 데이터를 통해 데이터 가져오기

// require_once("./my_db.php");
// $conn = my_db_conn();

// $stmt = $conn->prepare($sql);
// $stmt -> execute($arr_prepare);

// print_r($stmt->fetchAll());