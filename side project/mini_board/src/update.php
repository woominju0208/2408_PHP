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

        $file = $_FILES["file"];
        // var_dump($file); exit;

// 수정시 content 내용 수정했는데 사라짐 > 오류 발생시 post처리 확인 content획득 뒤에 echo$content exit; 를 입력해서 값이 출력안되면 post에 content 획득 부분 오류
// 오류시 틀린부분 하단 html확인 후에 위에 관련 php 확인
        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        $conn->beginTransaction();

        $arr_prepare = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
        ];
        // var_dump($file); exit;
        // file 저장 처리
        if($file["name"] !== "") {

            // 기존 파일 삭제
            $arr_prepare_select = [
                "id" => $id
            ];

            $result = my_board_select_id($conn, $arr_prepare_select);
            if(!is_null($result["img"])) {
                unlink(MY_PATH_ROOT.$result["img"]);
                // unlink: 파일 삭제 
            }

            // 새 파일 저장
            $type = explode("/", $file["type"]);
            $extension = $type[1];
            $file_name = uniqid().".".$extension;
            // var_dump($file_name); exit;
            $file_path = "/img/".$file_name;
    
            move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);

            $arr_prepare["img"] = $file_path; 
            // 이미지가 빈 문자열이 아닐시 $arr_prepare에 이미지를 넣어준다.(db에 이미지 경로 저장)
        } 


        

        my_board_update($conn, $arr_prepare);

        // commit
        $conn->commit();

        // detail page 이동
        header("Location: /detail.php?id=".$id."&page=".$page);
        exit;  // 밑에 불필요한 에러발생을 막기위해 exit 한다.
    }

}catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {  // !is_null($conn)만으론 rollBack하기 어렵 inTransaction()추가 해야 정확
        $conn->rollBack();
        // is_null 이 아니고  트랜잭션이 시작했을때 롤백 
        // (!is_null()$conn && $conn->inTransaction()) (앞에 먼저 실행하고 뒤에 실행하기 때문에 순서지키기)
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
        require_once(MY_PATH_HEADER);
    ?>
    <main>
        <!-- 나 자신에서 업데이트 해야하기 때문에 주소가 같은 update이다. -->
        <form action="/update.php" method="post" enctype="multipart/form-data">
            <!-- submit 처리를 실행했을때 action이 detail로 하면 detail엔 post가 없기 때문에 form 태그 위치에 같은 위치인 update.php 적용 상단 post실행-->
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
            <div class="box">
                <div class="box_title">이미지</div>
                <div class="box_content">
                    <input type="file" name="file" id="file">
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