<?php

require_once("./my_db.php");

// $conn 변수가 아무값도 초기화 되지 않았기 때문에 미리 $conn 변수에 null 값을 줘서 초기화 시켜준다.
// (그래야 어느부분에서 오류가 난건지 알수가 있다.)
$conn = null;

// 예외처리문
try{
    //  PDO Class 인스턴스화
    $conn = my_db_conn();
    // $conn->beginTransaction(); // 트랜잭션 시작
    // update,insert 문 둘다 변수의 이름만 다르면 여러가지 넣어도 된다. 
    $sql = 
        " UPDATE employees "
        ." SET "
        ."      name = :name "
        ."      ,updated_at = NOW() "
        ."      ,gender = :gender "
        ." WHERE "
        ."      emp_id = :emp_id "
        ;
$arr_prepare = [
    "name" => "갑순이"
    ,"emp_id" => 100001 
    ,"gender" => "F"
];

$conn->beginTransaction(); // 트랜잭션 시작
// 트랜잭션 시작은 위에 적어도 괜찮다

$stmt = $conn->prepare($sql);                // 쿼리준비
$result_flg = $stmt->execute($arr_prepare);  // 쿼리실행
$result_cnt = $stmt->rowCount();             // 영향받은 레코드 수 반환


// 영향 받은 레코드 수 이상
if($result_cnt !== 1) {
    throw new Exception("수정 레코드수 이상");
}


$conn->commit();    // 커밋처리
} catch(Throwable $th) {
    // PDO 인스턴스화 됐는지 확인    
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    // 오류가 날시 rollback으로 오류문구가 뜨면서 데이터가 들어가지 않음
    echo $th->getMessage();
}

// 밑에 if문으로 rollback실행을 적어두고 예외 실행상황도 위에 if문으로 다 적어두면 오류가 날시 rollback되어 데이터가 바뀌지 않는다.

// 프로그램의 실행순서는 위에서 아래 다음엔 오른쪽에서 왼쪽으로 실행된다.
//  $conn = my_db_conn(); 일때  my_db_conn()이 실행되고 다음 $conn 실행