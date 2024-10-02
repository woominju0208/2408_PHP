<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try{
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET" ) {
        // GET 처리
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    
        if($id < 1) {
            throw new Exception("파라미터 오류");
        }
    
        $conn = my_db_conn();
        $arr_prepare = [
            "id" => $id
        ];
    
        $result = my_board_select_id($conn, $arr_prepare);
    } else {
        // POST 처리
        $id = isset($_POST["id"]) ? $_POST["id"] : 0;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        $conn = my_db_conn();
        $conn->beginTransaction();
        $arr_prepare = [
            "id" => $id
        ];

        my_board_delete($conn, $arr_prepare);

        $conn->commit();

        header("Location: /");
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
        <div class="main-list">
            <p>My Recipes</p>
            <p><?php echo $result["id"] ?></p>
        </div>
            <div class="item">
                <!-- <a href=""><button class="btn-small content-btn"><</button></a> -->
                <div class="content-img">
                    <?php if(is_null($result["image"])) { ?>
                    <img class="img-insert" src="/img/no-photo.avif">
                    <?php } else { ?>
                    <img class="img-insert" src=<?php echo $result["image"] ?>>
                    <?php } ?>
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
                    <form action="/delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
                        <button class="btn-small btn-eng" type="submit">삭제</button>
                        <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-small btn-eng" type="button">취소</button></a>
                        <!--모달 팝업-->
                        <div class="modal hidden">
                            <div class="modal-overlay"></div>
                            <div class="modal-content">
                                <h3>삭제 페이지</h3>
                                <p>정말로 삭제 하시겠습니까?</p>
                                <div class="btn_modal">
                                    <button type="submit" class="close_btn">삭제</button>
                                    <button type="button" class="close_btn" id="close">닫기</button>
                                </div>
                            </div>
                        </div>
                        <script src="./modal.js"></script>


                        <!-- <div class="modal">
                            <div class="modal_popup">
                                <h3>삭제 페이지</h3>
                                <p>정말로 삭제 하시겠습니까?</p>
                                <div class="btn_modal">
                                    <button type="submit" class="close_btn">삭제</button>
                                    <button type="button" class="close_btn">닫기</button>
                                </div>
                            </div>
                        </div>
                            <script src="./modal.js"></script> -->
                    </form>
                </div>
    </main>
</body>
</html>

