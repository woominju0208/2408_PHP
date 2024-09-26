<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try{
    // id 획득
    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0; 
    // page 획득
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

    if($id < 1) {
        throw new Exception("파라미터 오류");
    }
    

    // PDO Instance
    $conn = my_db_conn();

    $arr_prepare = [
        "id" => $id
    ];

    $result = my_board_select_id($conn, $arr_prepare);

}catch(Throwable $th) {
    require_once(MY_PATH_ERROR);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상세 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/detail.css">
</head>
<body>
    <?php
        require_once(MY_PATH_ROOT."header.php");
    ?>
    <main>
        <div class="main_content">
            <div class="box">
                <div class="box_title">게시글 번호</div>
                <div class="box_content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box">
                <div class="box_title">제목</div>
                <div class="box_content"><?php echo $result["title"] ?></div>
            </div>
            <div class="box">
                <div class="box_title">내용</div>
                <div class="box_content"><?php echo $result["content"] ?></div>
            </div>
            <div class="box">
                <div class="box_title">작성일자</div>
                <div class="box_content"><?php echo $result["created_at"] ?></div>
            </div>
 <!-- textarea로 isnert쪽을 적어야 숫자,문자 전부 영역밖을 나가지않는다. 그냥 div로 입력해서 숫자일때 영역 나감  -->
        </div>
        <div class="main_footer">
            <a href="/update.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn_small" type="button">수정</button></a>
            <a href="/index.php?page=<?php echo $page ?>"><button class="btn_small" type="button">취소</button></a>
            <a href="/delete.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn_small" type="button">삭제</button></a>
        </div>
    </main>
</body>
</html>