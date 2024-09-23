<?php

require_once("../Ex/my_db.php");

// 3명의 신규 사원 정보를 employees에 추가(한명 아닌 여러명 한번에 insert)
// 성공한건 삽입되고 실패한 것만 안들어감
// 둘리,고길동은 들어가고 희동이는 오류로 삽입x

$data = [
    ["name" => "둘리", "birth" => "1986-01-01", "gender" => "M"]
    ,["name" => "희동이", "birth" => "ㅁㄴㅇㅇ", "gender" => "M"]
    ,["name" => "고길동", "birth" => "1968-01-01", "gender" => "M"]
];

$conn = null;

try{
    $conn = my_db_conn();

    foreach($data as $item) {
        try{
            // transcation 시작
            $conn->beginTransaction();

            // -------------------------------
            // 새로운 사원 정보 삽입
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

        }catch(Throwable $th) {
            if(!is_null($conn)) {
                $conn->rollBack();
            }
            echo "안쪽 try문 : " .$th->getMessage();
        }
    }

}catch(Throwable $th) {
    echo "바깥쪽 try문 : " .$th->getMessage();
}