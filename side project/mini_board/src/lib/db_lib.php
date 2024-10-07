<?php
// require_once("../con fig.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");


function my_db_conn() {
    $option = [
        PDO::ATTR_EMULATE_PREPARES      => false
        ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
    ];
    
    return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}
// my_db_conn();

// board select 페이지네이션
function my_board_select_pagination(PDO $conn, array $arr_param) {
    // SQL
    $sql = 
        "SELECT"
        ."      * "
        ." FROM "
        ."      board "
        ." WHERE "
        ."      deleted_at is NULL "
        ." ORDER BY "
        ."      created_at DESC "
        ."      , id DESC "
        ." LIMIT :list_cnt OFFSET :offset "
    ;

    $stmt = $conn->prepare($sql);     // 쿼리 준비
    $result_flg = $stmt->execute($arr_param);  // 쿼리 실행
    // my_board_select_pagination 함수에 $arr_param이라는 parameter를 저장후 실행에 파라미터 입력

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }   

    return $stmt->fetchAll();
    // if로 오류사항이 없으면 fetch해서 실행
    // $stmt->fetchall(); 에서 $stmt return으로 수정
}

// board 테이블 유효 게시글 총 수 획득
function my_board_total_count(PDO $conn) {
    // SQL
    $sql =
        "SELECT"
        ."      COUNT(*) cnt "   // COUNT(*) 를 별칭으로 cnt 로 적용
        ." FROM "
        ."      board "
        ." WHERE "
	    ."      deleted_at IS NULL "
    ;

    $stmt = $conn->query($sql);     // 쿼리 준비 없이 바로 실행
    $result = $stmt->fetch();
    // fetch는 위에서 부터 하나씩 들고오면 fetchall 은 한번에 가져온다

    return $result["cnt"];  // 쿼리문 cnt = COUNT(*)

}


// board 테이블 insert 처리
function my_board_insert(PDO $conn, array $arr_param) {
    // SQL
    $sql =
        " INSERT INTO board( "
        ."      title "
        ."      ,content "
        ."      ,img "
        ." ) "
        ." VALUES( "
        ."      :title "
        ."      ,:content "
        ."      ,:img "
        ." ) "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }
    // rowCount 내장함수 의미 알아두기!
    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Insert Count 이상");
    }

    return true;
}

// board 테이블 detail 처리
// id로 게시글 조회
function my_board_select_id(PDO $conn, array $arr_param) {
    $sql =
        " SELECT "
        ."      * "
        ." FROM "
        ."      board "
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);
    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    return $stmt->fetch();
}

// board 테이블 update 처리
function my_board_update(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE board "
        ." SET "
        ."      title = :title"
        ."      ,content = :content "
        ."      ,updated_at = NOW() "
        .(isset($arr_param["img"]) ? "      ,img = :img " : "")
        // 동적쿼리 작성 이미지를 넣을땐 적용되고 안넣을땐 적용x
        // ."      ,img = :img " : 정적쿼리로 배열의 갯수가 맞지 않기때문에 x
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);
    if(!$result_flg) {   // 쿼리가 실행됐는지 체크
        throw new Exception("쿼리 실행 실패");
    }

    if($stmt->rowCount() !== 1) {  // 업데이트 갯수가 하나인지 체크
        throw new Exception("Update Count 이상");
    }
    return true;
}

// board 테이블 레코드 삭제
function my_board_delete_id(PDO $conn, array $arr_param) {
    $sql =
    " UPDATE board "
    ." SET "
    ."      updated_at = NOW() "
    ."      ,deleted_at = NOW() "
    ." WHERE "
    ."      id = :id "
    ;
// 현업에선 데이터 삭제는 일정기간이 지나야 삭제 지금은 deleted_at로 소프트 삭제만 한다 > 그래서 update
// delete 문 X
    // $sql =
    // " DELETE FROM board "
    // ." WHERE "
    // ."      id = :id "
    // ;

    $stmt = $conn->prepare($sql);  // 쿼리준비
    $result_flg = $stmt->execute($arr_param);  // 쿼리실행
    if(!$result_flg) {     
        throw new Exception("쿼리 실행 실패");  // 쿼리실행 오류찾기
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Delete Count 이상"); // 삭제 갯수 오류찾기
    }
    return true;
}