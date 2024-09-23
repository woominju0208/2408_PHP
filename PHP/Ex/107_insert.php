<?php
require_once("./my_db.php");

// $conn = null;
try {
    $conn = my_db_conn();

    // sql
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
    "name" => "홍길동"
    ,"birth" => "2000-01-01"
    ,"gender" => "M"
];

// transaction 시작
$conn->beginTransaction();


$stmt = $conn->prepare($sql);  // 쿼리준비
$exec_flg = $stmt->execute($arr_prepare);  // 쿼리실행
$result_cnt = $stmt->rowCount();           // 영향 받은 레코드 수를 반환

// 쿼리 실행 예외(execute에서 실패할 확률이 제로에 가깝지만 만약에 일어났을 경우를 대응)
if(!$exec_flg) {
    throw new Exception("execute 예외 발생", "1");  // 강제로 예외 발생
}
// Exception는 예외클래스의 최상위 클래스

// $result_cnt = 0;
// 영향 받은 레코드 수 이상
if ($result_cnt !== 1) {
    throw new Exception("레코드수 이상");   // 강제로 예외 발생
}
// Exception("execute 예외 발생")이라는 클래스가 false 실패할시 throw때문에 catch쪽으로 간다.


    $conn->commit();
} catch(Throwable $th) {
    // PDO 인스턴스화 됐는지 확인
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    $conn->rollBack();
    // 오류가 날시 rollback으로 오류문구가 뜨면서 데이터가 들어가지 않음
    echo $th->getCode()." " .$th->getMessage();
}