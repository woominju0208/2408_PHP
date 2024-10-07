<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;
$max_board_cnt = 0;
$max_page = 0;

try {
    $conn = my_db_conn();


    // max page 획득 처리
    $max_board_cnt = my_board_total_count($conn);
    $max_page = (int)ceil($max_board_cnt/MY_LIST_CNT);

    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $offset = ($page - 1) * MY_LIST_CNT;
    // 화면 표시 시작 페이지 버튼 시작 값
    $start_page_button_number = (int)(floor(($page - 1) / MY_PAGE_BUTTON_CNT) * MY_PAGE_BUTTON_CNT) +1;
    // 1~5 => 1  6~10 -> 6  11~15 -> 11

    $next_page = $start_page_button_number + 5;
    $prev_page = $start_page_button_number - 5;

    // 화면 표시 시작 페이지 버튼 마지막 값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_CNT - 1);

    // max page 초과시 페이지 버튼 마지막 값 조절
    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;

    $prev_page_button_number = $page - 1 < 1 ? 1 : $page - 1;
    // $prev_page_button_number = $page - 1 < 1 ? 1 : (int)floor(($page - 1) / MY_PAGE_BUTTON_CNT) -6;

    $next_page_button_number = $page + 1 > $max_page ? $max_page : $page + 1;
    // $next_page_button_number = $page + 1 > $max_page ? $max_page : (int)((floor(($page - 1) / MY_PAGE_BUTTON_CNT) * MY_PAGE_BUTTON_CNT) +1) + 5; 

    

    $arr_prepare = [
        "list_cnt" => MY_LIST_CNT
        ,"offset" => $offset
    ];



    $result = my_board_select_pagination($conn, $arr_prepare);
    // var_dump($result);
} catch(Throwable $th) {
    require_once(MY_PATH_ERROR);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
    <!-- <script src="https://kit.fontawesome.com/31ae0d76f8.js" crossorigin="anonymous"></script> -->
</head>
<body>
    <?php
        require_once(MY_PATH_HEADER);
     ?>
    <main>
        <div class="main-top">
            <a href="/insert.php"><button class="btn-middle">Insert</button></a>
        </div>
        <div class="main-list">
            <p>New Recipes</p>
            <div class="item">
                <?php if($page !== 1) { ?>
                    <a href="/index.php?page=<?php echo $page -1 ?>"><button class="btn-small content-btn"><</button></a>
                <?php } ?>

                <?php foreach($result as $item) { ?>
                    <a href="/detail.php?id=<?php echo $item["id"] ?>&page=<?php echo $page ?>">
                        <div class="list-content">
                            <div class="content-id">
                                <div><?php echo $item["id"] ?></div>
                            </div>
                            <div class="content-img">
                                <?php if(is_null($item["image"])) { ?>
                                    <img class="img-insert" src="/img/no-photo.avif">
                               <?php } else { ?>
                                    <img class="img-insert" src= <?php echo $item["image"] ?>>
                                <?php } ?>
                            </div>
                            <div class="list-content-title"><?php echo $item["title"] ?></div>
                            <div><?php echo $item["created_at"] ?></div>
                            <!-- <button class="btn-content"><i class="fa-solid fa-arrow-right"></i></button> -->
                        </div>
                    </a>
                <?php } ?>

                <?php if($page !== $max_page) { ?>
                    <a href="/index.php?page=<?php echo $page + 1 ?>"><button class="btn-small content-btn">></button></a>
                <?php } ?>
            </div>

            <div class="main-footer">
                <?php if(($page !== 1)&&(!($prev_page < 1))) { ?>
                <a href="/index.php?page=<?php echo $prev_page ?>"><button class="btn-small">◀</button></a>
                <?php } ?>
                <?php for($i = $start_page_button_number; $i <=$end_page_button_number; $i++) { ?>
                    <a href="/index.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $page === $i ? "btn_selected" : "" ?>"><?php echo $i ?></button></a>
                <?php } ?>
                <?php if(($page !== $max_page)&&(!($next_page > $max_page))) { ?>
                <a href="/index.php?page=<?php echo $next_page ?>"><button class="btn-small">▶</button></a>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>