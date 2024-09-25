<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");


function my_db_conn() {
    $option = [
        PDO::ATTR_EMULATE_PREPARES      => false
        ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
    ];

    return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}


// board select 페이지네이션
function my_board_select_pagination(PDO $conn, array $arr_param) {
    // SQL
    $sql = 
        "SELECT"
        ."      * "
        ." FROM "
        ."      board "
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
        ." ) "
        ." VALUES( "
        ."      :title "
        ."      ,:content "
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

function my_board_update(PDO $conn, array $arr_param) {
    $sql =
    " UPDATE board "
    ." SET "
    ."      title = :title"
    ."      ,content = :content "
    ."      ,updated_at = NOW() "
    ." WHERE "
    ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);
    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    return true;
}