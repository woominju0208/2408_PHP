<?php

// 나의 급여를 2500만원으로 변경해주세요.
require_once("../Ex/my_db.php");

$conn = null;

try {
    $conn = my_db_conn();

    $conn->beginTransaction();
    // ------------------------
    // 기존 급여 수정
    $sql = 
        " UPDATE salaries "
        ." SET "
        ."      end_at = DATE(NOW())"
        ."      ,updated_at = NOW() "
        ." WHERE "
        ."      emp_id = :emp_id "
        ."      AND end_at IS NULL " 
    ;
    // : 가 prepare_statment 라고 인식시켜주는것 

    $arr_prepare = [
        "emp_id" => 100014
    ];

    // DB준비, 실행, 오류조건
    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    // execute 는 한번만 사용되기 때문에 따로 변수로 담지 않고 바로 if문으로 체크해도 된다.
    // $result_cnt = $stmt->rowCount();
    // rowCount 는 한번만 사용되기 때문에 따로 변수로 담지 않고 바로 if문으로 체크해도 된다.

    if(!$result_flg) {
        throw new Exception("Update Query Error : salaries");
    }

    if($stmt->rowCount() !==1) {
        throw new Exception("Update Count Error : salaries");
    }

    // ------------------------
    // 새로운 급여 이력 추가
    $sql =
        " INSERT INTO salaries( "
        ."       emp_id "
        ."      ,salary "
        ."      ,start_at "
        ." ) "
        ." VALUES( "
        ."      :emp_id "
        ."      ,:salary "
        ."      ,DATE(NOW()) "
        ." ) "
        ;

    $arr_prepare = [
        "emp_id" => 100014
        ,"salary" => 25000000
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();
    
    if(!$result_flg) {
        throw new Exception("Insert Query Error : salaries");
    }

    if($result_cnt !==1) {
        throw new Exception("Insert Count Error : salaries");
    }

    $conn->commit();

} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getMessage();
}