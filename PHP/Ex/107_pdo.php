<?php

// ---------------
// PDO Class : DB 엑세스 방법 중 하나

// // DB 접속 정보
// $my_host = "localhost";   // DB Host
// // $my_host = "127.0.0.1";   // ip로도 접속

// $my_user = "root";         //DB 계정명
// $my_port = "3306";       // port
// $my_password = "php504";   //DB 계정비밀번호
// $my_db_name = "dbsample";  // 접속할 DB명 
// $my_charset = "utf8mb4";   // DB Charset

// $my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset;  // DSN: data source name

// // PDO 옵션 설정
// $my_otp = [
//     // Prepared Statment로 쿼리를 준비할 때, PHB 와 DB 어디에서 에뮬레이션 할지 여부를 결정
//     PDO::ATTR_EMULATE_PREPARES     => false   // DB에서 에뮬레이션 하도록 설정
//     // PDO에서 예외를 처리하는 방식을 지정 
//     ,PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
//     // DB에 결과를 fetch하는 방식을 지정
//     ,PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC   // 연관배열(fetch_assoc)로 fetch
// ];

// // DB 접속
// $conn = new PDO($my_dsn, $my_user, $my_password, $my_otp);

// // 여기까지 있는 문장은 다 똑같이 적는다.


// // select
// $sql = "SELECT
//             *
//         FROM employees
//         ORDER BY employees.emp_id ASC
//         LIMIT 5";

// // query($sql)를 return 함으로써 PDO Statment class라는 class를 $stmt에 담음  $stmt안에 PDO Statment class 라는 class가 담김
// $stmt = $conn->query($sql);  // PDO::query() : 쿼리 준비 + 실행
// $result = $stmt->fetchAll(); // 질의 결과를 패치
// print_r($result);
// // column  명들이 key 가 되는거고 레코드들이 값이 된다.

// // 사번과 이름만 출력(루프 돌려서 출력)
// foreach($result as $item) {
//     echo $item["emp_id"]." ".$item["name"]."\n";
// }

//  DB 정보
$my_host = "localhost";  // host
$my_port = "3306";       // port
$my_user = "root";       // user
$my_password = "php504"; // password
$my_db_name = "dbsample"; // DB name
$my_charset = "utf8mb4";  // charset : 컴퓨터가 용어를 어떻게 인식할것인가 를 정함 

// DSN
// 이전 소스코드는 주석처리로 남기고 코멘트아웃으로 남겨두기
$my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset;

// PDO Option(여러가지 있지만 3가지 구성)
$my_option = [
    // prepared statment의 에뮬레이션 설정
    PDO::ATTR_EMULATE_PREPARES    => false
    // 예외 발생시, 예외 처리 방법 설정
    ,PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
    // Fetch할 때 데이터 타입 설정
    ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
];

// PDO Class 인스턴스화
$conn = new PDO($my_dsn, $my_user, $my_password, $my_option);

// // select
// $sql = " SELECT "
//         ."      * "
//         ." FROM "
//         ."      employees "
//         ." LIMIT 3 "
//         ;

// $stmt = $conn->query($sql); // 쿼리 실행 및 결과 반환
// $result = $stmt->fetchAll(); // 결과 Fetch

// print_r($result);


// select예제
$sql = " SELECT "
        ." * "
        ." FROM "
        ."      employees "
        ." WHERE "
        ."      emp_id = :emp_id1 "
        ." OR  emp_id = :emp_id2 "
        ;
// prepare statment 를 사용할때 : 를 필수로 적어줘야함

$prepare = [
     "emp_id1" => 10001
    ,"emp_id2" => 10002 
];
// 10001,10002 이 요청한 조건 $prepare = [];은 쿼리준비 단계
// $prepare 이 배열인 이유는 execute가 보내줘야하는 데이터타입이 배열이어야 하기 때문

$stmt = $conn->prepare($sql); // 쿼리준비
$stmt->execute($prepare);     // 쿼리실행
// $prepare이라는 메소드를 통해 쿼리를 준비해주고 쿼리를 실행
$result = $stmt->fetchAll();  // 결과 fetch

print_r($result);

// 상황에 따라 기본 select를 하던지 prepare statment로 select하든지 사용 (보통 preprare statment 사용)