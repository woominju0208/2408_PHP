<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {

    // id 획득
    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0; 
    // page 획득
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

    if($id < 1) {
        throw new Exception("파라미터 오류");
    }
    

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
        require_once(MY_PATH_HEADER);
     ?>
    <main>
        <div class="main-list">
            <p>My Recipes</p>
            <p><?php echo $result["id"] ?></p>
        </div>
            <div class="item">
                <!-- <a href=""><button class="btn-small content-btn"><</button></a> -->

                <div class="content-img">
                    <img class="img-insert" src=<?php echo $result["image"] ?>>
                </div>
                <div class="content-detail">
                    <div style="word-break: break-all;" class="content-detail-size">
                        <div class="detail-title"><?php echo $result["title"] ?></div>
                        <div class="detail-content"><?php echo $result["content"] ?></div>
                        <div class="detail-create_at"><?php echo $result["created_at"] ?></div>
                    </div>
                </div>
                <!-- <a href=""><button class="btn-small content-btn">></button></a> -->
            </div>
                <div class="main-footer">
                    <a href="/update.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-small btn-eng" type="button">수정</button></a>
                    <a href="/index.php?page=<?php echo $page ?>"><button class="btn-small btn-eng" type="button">취소</button></a>
                    <a href="/delete.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-small btn-eng" type="button">삭제</button></a>
                </div>
    </main>
</body>
</html>