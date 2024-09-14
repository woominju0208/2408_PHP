<?php

require_once("./my_db.php");

try{
    $conn = my_db_conn();

    $id = 1;
    $name = "홍길동";
    // Prepared Statment(SQL Injection의 공격을 막기위해 써야함 보안을 위해)
    $sql = " SELECT "
            ."    *  "
            ." FROM employees "
            ." WHERE "
            ."    emp_id = :emp_id "
            ."    AND name = :name "
            // 관습적으로 column 명이랑 뒤에 명을 같게한다.
    ;
    $arr_prepare =[
        ":emp_id" => $id
        ,"name" => $name
    ];

    $stmt = $conn->prepare($sql); // DB 질의 준비            // $conn->prepare($sql) 은 conn에 my_db_conn라는 class고 prepare라는 함수에 $sql이라는 아규먼트를 나타냄
    $stmt->execute($arr_prepare); // 질의 실행
    $result = $stmt->fetchAll();

    } catch(Throwable $th) {
        echo $th->getMessage();  // 예외 메세지 출력
    }
//     $conn = my_db_conn();

//     $id = 1;
//     // Prepared Statment(SQL Injection의 공격을 막기위해 써야함 보안을 위해)
//     $sql = " SELECT "
//             ."    *  "
//             ." FROM employees "
//             ." WHERE "
//             ."    emp_id = :emp_id "
//             ."    AND name = :name "
//             // 관습적으로 column 명이랑 뒤에 명을 같게한다.
//     ;
//     $arr_prepare =[
//         ":emp_id" => $id
//         ,"name" => "홍길동"
//     ];

//     $stmt = $conn->prepare($sql); // DB 질의 준비
//     $stmt->execute($arr_prepare); // 질의 실행
//     $result = $stmt->fetchAll();

// print_r($result);
// // 유지보수를 위해 한줄한줄 ""을 넣어준다 그리고 " " 안에 앞뒤로 공백(넣지 않으면 문장문장 이어져서 이상한 이름으로 조합)을 넣어줘야한다.
