<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

// POST 처리 [REQUEST_METHOD] => GET
// 혹시라도 소문자 POST가 올까봐 strtoupper(모두 대문자 지정) 장치를 넣어둠
$conn = null;
// post 처리
if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    try{
        // PDO Instance
        $conn = my_db_conn();

        // insert 처리
        $arr_prepare =[
            "title" => $_POST["title"]
            ,"content" => $_POST["content"]
        ];

        // begin transaction(트랜잭션 시작)
        $conn->beginTransaction();
        my_board_insert($conn, $arr_prepare);

        $conn->commit();

        // 내장함수 header : html head안에 document root 위치(index.php)를 넣어준다.
        // header("Location: /") 꼭 대소문자 문법 지켜서 적기
        header("Location: /");
        exit;
    } catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ERROR);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>작성 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/insert.css">
</head>
<body>
    <?php
        require_once(MY_PATH_HEADER);
    ?>
    <main>
        <!-- 내용을 insert하면 내 insert페이지로 이동 insert하기 때문에 method post -->
        <form action="/insert.php" method="post"> 
            <div class="box title_box">
                <div class="box_title">제목</div>
                <div class="box_content">
                    <input type="text" name="title" id="title">
                </div>
            </div>
            <div class="box content_box">
                <div class="box_title">내용</div>
                <div class="box_content">
                    <textarea name="content" id="content"></textarea>
                </div>
            </div>
            <div class="main_footer">
                <button class="btn_small" type="submit">작성</button>
                <a href="/"><button class="btn_small" type="button">취소</button></a>
                <!-- insert.php 엔 내용값때메 POST 만 넣었는데 취소버튼이 만약/index.php?page=3 을 가고싶다 그럼 else 에 GET도 추가한다. -->
            </div>
        </form>
    </main>
</body>
</html>
