<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

        // page 획득
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }
        // PDO Instance 
        $conn = my_db_conn();

        // ----------------------

        // 데이터 조회
        // ----------------------
        $arr_prepare = [
            "id" => $id
        ];

        $result = my_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리

        // parameter 획득
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

        // page 획득
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;

        // title 획득
        $title = isset($_POST["title"]) ? $_POST["title"] : "";

        // content 획득
        $content = isset($_POST["content"]) ? $_POST["content"] : "";


        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        $arr_prepare = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
        ];

        $conn->beginTransaction();
        my_board_update($conn, $arr_prepare);

        $conn->commit();
        header("Location: /detail.php?id=$id&page=$page");
        exit;
    }

}catch(Throwable $th) {
    if(!is_null($conn)) {
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
    <title>수정 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/update.css">
</head>
<body>
    <?php
        require_once(MY_PATH_ROOT."/header.php");
    ?>
    <main>
        <!-- 나 자신에서 업데이트 해야하기 때문에 주소가 같은 update이다. -->
        <form action="/update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <!-- input hidden 타입은 값은 같이 넘어가는데 화면으론 보이지 않음(유저가 아닌 우리가 세팅하는 값을 넣어주고 싶을때 사용) -->
            <div class="box title_box">
                <div class="box_title">글 번호</div>
                <div class="box_content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box title_box">
                <div class="box_title">제목</div>
                <div class="box_content">
                    <input type="text" name="title" id="title" value="<?php echo $result["title"] ?>">
                </div>
            </div>
            <div class="box content_box">
                <div class="box_title">내용</div>
                <div class="box_content">
                    <textarea name="content" id="content"><?php echo $result["content"] ?></textarea>
                </div>
            </div>
            <div class="main_footer">
                <button class="btn_small" type="submit">완료</button>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn_small" type="button">취소</button></a>
            </div>
        </form>
    </main>
</body>
</html>