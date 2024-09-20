<?php

require_once("../Ex/my_db.php");

// 3명의 신규 사원 정보를 employees에 추가(한명 아닌 여러명 한번에 insert)
// 하나라도 실패하면 전부 롤백

$data = [
    ["name" => "둘리", "birth" => "1986-01-01", "gender" => "M"]
    ,["name" => "희동이", "birth" => "1990-01-01", "gender" => "M"]
    ,["name" => "고길동", "birth" => "1968-01-01", "gender" => "M"]
];

$conn = null;

try {
    $conn = my_db_conn();

    // transcation 시작
    $conn->beginTransaction();
    // 복수의 데이터 루프
    foreach($data as $item) {
        $sql =
            " INSERT INTO employees( "
            ."      name "
            ."      ,birth "
            ."      ,gender "
            ."      ,hire_at "
            ." ) "
            ." VALUES( "
            ."      :name "
            ."      ,:birth "
            ."      ,:gender "
            ."      ,DATE(NOW()) "
            ." ) "
        ;

        $arr_prepare = [
            "name" => $item["name"]
            ,"birth" => $item["birth"]
            ,"gender" => $item["gender"]
        ];
    }
    
    // 시도 : prepare,execute를 foreach 안에 넣으면 배열갯수만큼 여러번 실행되어서 따로 빼고 싶었다.
    // 과정 : foreach 문 밖에 prepare,execute 을 적으니 foreach는 배열을 반복만 돌다가 마지막 고길동 배열에서 멈추고 고길동 부분만 insert해서 데이터가 삽입되었다.
    // 결과 : 여러 배열 데이터가 들어가지 못하고 한개의 데이터만 삽입(실패) > 
    //        $sql 과 $arr_prepare 의 반복문도 설정해줘야하고 여러 설정이 필요하다. (많이 어려워짐)     
    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();
    
    if(!$result_flg) {
        throw new Exception("Insert Query Error : salaries");
    }

    if($result_cnt !==1) {
        throw new Exception("Insert Count Error : salaries");
    }

    // commit
    $conn->commit();
    
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollback();
    }
    echo $th->getMessage();
}   