<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;
$max_board_cnt = 0;
$max_page = 0;

try{
    $conn = my_db_conn();

    // ---------------------------------
    // max page 획득 처리
    // ---------------------------------
    $max_board_cnt = my_board_total_count($conn);     // 게시글 총 수 획득
    $max_page = (int)ceil($max_board_cnt/MY_LIST_COUNT);  // max page 획득

     // ---------------------------------
        // pagination 설정 처리
    // ---------------------------------
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;  // 현재 페이지 획득
    $offset = ($page - 1) * MY_LIST_COUNT ;                 // 오프셋 설정
    $start_page_button_number = (int)(floor(($page - 1) / MY_PAGE_BUTTON_COUNT) * MY_PAGE_BUTTON_COUNT) +1;  // 화면 표시 시작 페이지 버튼 시작 값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1);                   //  화면 표시 시작 페이지 버튼 마지막 값
    // max page 초과시 페이지 버튼 마지막 값 조절(삼향 연산자)
    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;
    // 이전 버튼(삼향 연산자)
    $prev_page_button_number = $page - 1  < 1 ? 1 : $page - 1;
    // 다음 버튼(삼향 연산자)
    $next_page_button_number = $page + 1 > $max_page ? $max_page : $page + 1;

    $arr_prepare = [
        "list_cnt" => MY_LIST_COUNT
        ,"offset" => $offset
    ];

    $result = my_board_select_pagination($conn, $arr_prepare);

}catch(Throwable $th) {
    $th->getMessage();
    // require_once(MY_PATH_ERROR);
    // exit;
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
    <?php
        require_once(HEADER);
    ?>
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
            <?php
                foreach($result as $item) { ?>
                <div class="item list_content">
                    <div><?php echo $item["id"] ?></div>
                    <div><a href="/detail.php?id=<?php echo $item["id"] ?>&page=<?php echo $page ?>"><?php echo $item["title"] ?></a></div>
                    <div><?php echo $item["created_at"] ?></div>
            <?php } ?>
        </div>
        <div class="main_footer">
            <?php if($page !== 1) { ?> 
                <a href="/index.php?page=<?php echo $prev_page_button_number ?>"><button class="btn_small">이전</button></a>
            <?php } ?>
            <?php for($i = $start_page_button_number; $i <=$end_page_button_number; $i++) { ?> 
                <a href="/index.php?page=<?php echo $i ?>"><button class="btn_small <?php echo $page === $i ? "btn_selected" : "" ?>"><?php echo $i ?></button></a>
            <?php } ?>
            <?php if($page !== $max_page) { ?>
                <a href="/index.php?page=<?php echo $next_page_button_number ?>"><button class="btn_small">다음</button></a>
            <?php } ?>     
        </div>
    </main>
</body>
</html>