<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try{
    $conn =my_db_conn();

    
}catch(Throwable $th) {

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
        <div class="main-list">
            <p>My Recipes</p>
            <p>30</p>
        </div>
            <div class="item">
                <!-- <a href=""><button class="btn-small content-btn"><</button></a> -->
                <div class="content-img">
                    <img class="img-insert" src="../img/35614970-과일-디저트.jpg">
                </div>
                <div class="content-detail">
                    <div class="detail-title"><?php echo $result["title"] ?></div>
                    <div class="detail-content"><?php echo $result["content"] ?></div>
                    <div class="detail-create_at"><?php echo $result["created_at"] ?></div>
                </div>
                <!-- <a href=""><button class="btn-small content-btn">></button></a> -->
            </div>
                <div class="main-footer">
                    <a href="./index.html"><button class="btn-small btn-eng">삭제</button></a>
                    <a href="./detail.html"><button class="btn-small btn-eng">취소</button></a>
                </div>
    </main>
</body>
</html>