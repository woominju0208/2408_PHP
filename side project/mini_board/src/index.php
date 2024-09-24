<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    //PDO Instance
    $conn = my_db_conn();

    // ---------------------------------
        // pagination 설정 처리
    // ---------------------------------
    // $_GET , $_POST의 유저가 보내는 값은 전부 string 타입으로 와서 숫자페이지인 $_GET["page"] 앞에 (int)를 붙임
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $offset = ($page - 1) * MY_LIST_COUNT ;


    // ---------------------------------
        // pagination select 처리
    // ---------------------------------
        $arr_prepare = [
            "list_cnt" => MY_LIST_COUNT
            ,"offset"  => $offset
        ];

        // pagination select
        $result = my_board_select_pagination($conn, $arr_prepare);   // $arr_prepare가 유저가 요청한 값 $arr_param 은 my_board_select_pagination를 정의할때 외부에 값을 저장한 것
}catch(Throwable $th) {
    echo $th->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header>
        <h1>Mini Board</h1>
    </header>
    <main>
        <div class="main-top">
            <a href="./insert.html"><button class="btn_middle">글 작성</button></a>
            <!-- main btn만 오른쪽 정렬 해야하기 때문에 btn_middle를 감싸는 부모 div를 만들어 오른쪽 정렬 함 -->
        </div>
        <div class="main_list">
            <div class="item list_head">
                <div>게시글 번호</div>
                <div>게시글 제목</div>
                <div>작성일자</div>
            </div>
            <?php foreach($result as $item) { ?>
            <div class="item list_content">
                <div><?php echo $item["id"] ?></div>
                <div><a href="./detail.html"><?php echo $item["title"] ?></a></div>
                <div><?php echo $item["created_at"] ?></div>
            </div>
        <?php } ?>
            <!-- 반복되는 게시글 목록 하나로 작성 -->
        </div>
        <div class="main_footer">
            <a href="/index.php?page=1"><button class="btn_small">이전</button></a>
            <a href="/index.php?page=1"><button class="btn_small">1</button></a>
            <a href="/index.php?page=2"><button class="btn_small">2</button></a>
            <a href="/index.php?page=3"><button class="btn_small">3</button></a>
            <a href="/index.php?page=4"><button class="btn_small">4</button></a>
            <a href="/index.php?page=5"><button class="btn_small">5</button></a>
            <a href="/index.php?page=6"><button class="btn_small">다음</button></a>
        </div>
    </main>
</body>
</html>