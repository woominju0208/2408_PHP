<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        $id =isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        $page =isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        
        if($id < 1) {
            throw new Exception("파라미터 이상");
        }

        $conn = my_db_conn();

        // $conn->beginTransaction(); : 단순 조회시 트랜잭션 필요없음
        
        $arr_prepare = [
            "id" => $id
        ];

        // 데이터 조회
        $result = my_board_select_id($conn, $arr_prepare);
    } else {
        // POST 처리
        // -------------
        // 파라미터 획득
        // -------------
        $id =isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        
        if($id < 1) {
            throw new Exception("파라미터 이상");
        }
        
        $conn = my_db_conn();
        // delete로 데이터가 바뀌기 때문에 트랜잭션 시작
        $conn->beginTransaction();

        $arr_prepare = [
            "id" => $id
        ];

        // 삭제 처리
        my_board_delete_id($conn, $arr_prepare);

        // commit
        $conn->commit();

        // 리스트 페이지로 이동
        header("Location: /");
        exit;
    }
}catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    require_once(MY_PATH_ERROR);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삭제 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/delete.css">
</head>
<body>
    <?php
        require_once(MY_PATH_HEADER);
    ?>
    <main>
        <div class="main_header">
            <p>삭제하면 영구적으로 복구할 수 없습니다.</p>
            <p>정말로 삭제 하시겠습니까?</p>
        </div>
        <div class="main_content">
            <div class="box">
                <div class="box_title">게시글 번호</div>
                <div class="box_content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box">
                <div class="box_title">작성일</div>
                <div class="box_content"><?php echo $result["created_at"] ?></div>
            </div>
            <div class="box">
                <div class="box_title">제목</div>
                <div class="box_content"><?php echo $result["title"] ?></div>
            </div>
            <div class="box">
                <div class="box_title">내용</div>
                <div class="box_content"><?php echo $result["content"] ?></div>
            </div>
            <?php if(!is_null($result["img"])) { ?>
                <div class="box">
                    <div class="box_title">이미지</div>
                    <div class="box_content"><img src="<?php echo $result["img"] ?>" alt=""></div>
                </div>
            <?php } ?>
        </div>
        <div class="main_footer">
            <!-- a태그는 무조건 GET 메소드로 이동한다  -->
            <!-- 데이터변경은 무조건 POST -->
            <!-- 아ㅠ에 GET 처리를 했기 때문에 GET처리를 중복으로 쓸수 없다. -->
            <!-- 그래서 동의(삭제)버튼을 POST처리한것이다(form안에 동의버튼 넣기) -->
             <form action="/delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
                <button class="btn_small" type="submit">동의</button></a>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn_small" type="button">취소</button></a>
                <!-- 폼태그는 블록요소기 때문에 취소버튼도 폼태그안에 넣어주었다. -->
             </form>
        </div>
    </main>
</body>
</html>