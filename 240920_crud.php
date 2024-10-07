<?php

require_once("./PHP/Ex/my_db.php");

$conn = null;
// try {
    $conn = my_db_conn();

    // $conn->beginTransaction();

    $sql = 
        " SELECT "
        ."      * "
        ." FROM "
        ."      employees "
        ." WHERE "
        ."      emp_id =:emp_id "
    ;

    $arr_prepare = [
        "emp_id" => 100000
    ];

    $stmt = $conn->prepare($sql);    // 쿼리준비
    $result = $stmt->execute($arr_prepare);  // 쿼리실행
    $result = $stmt->fetchAll();  // 결과 fetch

        print_r($result);
        // if(!$result_flg) {
            //     throw new Exception("Insert Query Error : employees");
            // }
            
            // if($result_cnt !==1) {
            //     throw new Exception("Insert Count Error : employees");
            // }

            // $conn->commit();

// }catch(Throwable $th) {
//     if(!is_null($conn)) {
//          $conn->rollBack(); }   
//      echo $th->getMessage();
