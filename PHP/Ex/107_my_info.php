<?php
// 나의 사원 정보를 입력(급여,직급,부서 정보 포함)

require_once("./my_db.php");

$conn = null;

try{
    $conn = my_db_conn();

    // Transaction Start
    $conn->beginTransaction();

    // 사원테이블 insert
        $sql =
         " INSERT INTO employees( "
             ." name "
             ." ,birth "
             ." ,gender "
             ." ,hire_at "
         ." ) "
         ." VALUES( "
             ." :name "
             ." ,:birth "
             ." ,:gender "
             ." ,DATE(NOW()) "
         ." ) "
    ;

         $arr_prepare = [
            "name" => "우민주"
            ,"birth" => "2000-01-01"
            ,"gender" => "F"
         ];

    $stmt = $conn->prepare($sql);  // 쿼리준비
    $result_flg = $stmt->execute($arr_prepare);  // 쿼리실행
    $result_cnt = $stmt->rowCount();       // 영향받은 레코드 수 획득

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : employees ");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception(" Insert Count Error : employees ");
    }

    // INSERT 한 PK 획득
    // 사원테이블 생성후 다음테이블 만들시 한번만 lastInsertId를 넣는다.
    $emp_id = $conn->lastInsertId();

    // ---------------------------------
    // 급여테이블 Insert
    $sql =
        " INSERT INTO salaries( "
            ." emp_id "
            ." ,salary "
            ." ,start_at "
        ." ) "
        . " VALUES( "
            ." :emp_id "
            ." ,:salary "
            ." ,DATE(NOW()) "
        ." ) "
    ;
    
    $arr_prepare = [
        "emp_id" => $emp_id
        ,"salary" => 1000000000 
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : salaries");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : salaries");
    }

    // ---------------------------------
    // 직급테이블 Insert
    $sql =
        " INSERT INTO title_emps( "
            ." emp_id "
            ." ,title_code "
            ." ,start_at "
        ." ) "
        . " VALUES( "
            ." :emp_id "
            ." ,:title_code "
            ." ,DATE(NOW()) "
        ." ) "
    ;
    
    $arr_prepare = [
        "emp_id" => $emp_id
        ,"title_code" => "T001"
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : title_emps");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : title_emps");
    }

        // ---------------------------------
    // 부서테이블 Insert
    $sql =
        " INSERT INTO department_emps( "
            ." emp_id "
            ." ,dept_code "
            ." ,start_at "
        ." ) "
        . " VALUES( "
            ." :emp_id "
            ." ,:dept_code "
            ." ,DATE(NOW()) "
        ." ) "
    ;
    
    $arr_prepare = [
        "emp_id" => $emp_id
        ,"dept_code" => "D001"
    ];

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_prepare);
    $result_cnt = $stmt->rowCount();

    // 쿼리 실행 예외 처리
    if(!$result_flg) {
        throw new Exception("Insert Query Error : department_emps");
    }

    // 영향받은 레코드 수 예외 처리
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error : department_emps");
    }
    
    // commit
    $conn->commit();         
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getMessage(); 
}

// 인덴트 잘 표시하기

// 트랜잭션 : 여러가지 처리중 하나라도 실패하면 commit이 아닌 rollback으로 설정