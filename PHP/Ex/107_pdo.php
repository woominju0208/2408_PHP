<?php

// ---------------
// PDO Class : DB 엑세스 방법 중 하나

// DB 접속 정보
$my_host = "localhost";   // DB Host
// $my_host = "127.0.0.1";   // ip로도 접속

$my_user = "root";         //DB 계정명
$my_password = "php504";   //DB 계정비밀번호
$my_db_name = "dbsample";  // 접속할 DB명
$my_charset = "utf8mb4";   // DB Charset

$my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset;  // DSN: data source name

// PDO 옵션 설정
$my_otp = [
    // Prepared Statment로 쿼리를 준비할 때, PHB 와 DB 어디에서 에뮬레이션 할지 여부를 결정
    PDO::ATTR_EMULATE_PREPARES     => false   // DB에서 에뮬레이션 하도록 설정
    // PDO에서 예외를 처리하는 방식을 지정 
    ,PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
    // DB에 결과를 fetch하는 방식을 지정
    ,PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC   // 연관배열(fetch_assoc)로 fetch
];

// DB 접속
$conn = new PDO($my_dsn, $my_user, $my_password, $my_otp);

// 여기까지 있는 문장은 다 똑같이 적는다.


// select
$sql = "SELECT
            *
        FROM employees
        ORDER BY employees.emp_id ASC
        LIMIT 5";

// query($sql)를 return 함으로써 PDO Statment class라는 class를 $stmt에 담음  $stmt안에 PDO Statment class 라는 class가 담김
$stmt = $conn->query($sql);  // PDO::query() : 쿼리 준비 + 실행
$result = $stmt->fetchAll(); // 질의 결과를 패치
print_r($result);
// column  명들이 key 가 되는거고 레코드들이 값이 된다.

// 사번과 이름만 출력(루프 돌려서 출력)
foreach($result as $item) {
    echo $item["emp_id"]." ".$item["name"]."\n";
}

