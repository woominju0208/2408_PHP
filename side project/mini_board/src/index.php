<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;
$max_board_cnt = 0;
$max_page = 0;

try {

    //PDO Instance
    $conn = my_db_conn();
    // ---------------------------------
    // max page 획득 처리
    // ---------------------------------
    $max_board_cnt = my_board_total_count($conn);     // 게시글 총 수 획득
    $max_page = (int)ceil($max_board_cnt/MY_LIST_COUNT) ;  // max page 획득
    // 총 페이지 수를 페이지수로 나눈다음에 ceil로 올림 > 올림해야 소수점 나머지값은 다음 페이지로 넘어가야하니 올림 (ex 13개의 글이 있을때 2페이지가 아닌 3페이지까지)
    // ceil은 데이터형식이 float기 때문에 int로 형변환 > 그래야 int형변환 $max_page으로 하단 $page !== $max_page 로 값도 같고 형식도 같아야 하기 때문에 적용 

    // ---------------------------------
        // pagination 설정 처리
    // ---------------------------------
    // $_GET , $_POST의 유저가 보내는 값은 전부 string 타입으로 와서 숫자페이지인 $_GET["page"] 앞에 (int)를 붙임
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
    // $enxt_page_button_number = 7 + 1 > 8  크다 성립 x => $page + 1 적용 : 그래서 하단 다음if문에 $page 를 적용

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
    // catch 쪽엔 무조건 에러페이지를 불러와야한다. 
    require_once(MY_PATH_ERROR);
    exit;  // 에러부분만 나오고 그 이후 처리를 하지않음
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
        require_once(MY_PATH_ROOT."header.php");  // 여러번 들고오는 header부분도 상수처리 해두면 좋겠다.
    ?>
    <main>
        <div class="main-top">
            <a href="/insert.php"><button class="btn_middle">글 작성</button></a>
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
                <div><a href="/detail.php?id=<?php echo $item["id"] ?>&page=<?php echo $page ?>"><?php echo $item["title"] ?></a></div>
                <!-- id 와 page 둘다 가져와야 하기 때문에 &로 이어준다. -->
                <div><?php echo $item["created_at"] ?></div>
            </div>
        <?php } ?>
            <!-- 반복되는 게시글 목록 하나로 작성 -->
        </div>
        <div class="main_footer">
            <?php if($page !== 1) { ?> 
                <a href="/index.php?page=<?php echo $prev_page_button_number ?>"><button class="btn_small">이전</button></a>
            <?php } ?>
            <?php for($i = $start_page_button_number; $i <=$end_page_button_number; $i++) { ?> 
                <a href="/index.php?page=<?php echo $i ?>"><button class="btn_small <?php echo $page === $i ? "btn_selected" : "" ?>"><?php echo $i ?></button></a>
            <?php } ?>
            <?php if($page !== $max_page) { ?>     
            <!-- $page인 이유는 $next_page_button_number 일때 최대 값 -1 페이지(7)도
                 $max_page(8) 와 같다($page + 1 > $max_page ? $max_page : $page + 1 값은 $page+1 로 8)라는 결론이 나오기 때문에 최대 값 -1 페이지도 다음버튼이 사라진다. -->
                <a href="/index.php?page=<?php echo $next_page_button_number ?>"><button class="btn_small">다음</button></a>
            <?php } ?>
        </div>
        <!-- 화면에 출력해야하는 부분은 무조건 echo 를 넣어야 한다.(반복문은 출력이 필요없으니 echo X) -->
        <!-- ?page=1 은 HTTP Method 에 GET값(유저가 보내준 값)으로 1번 페이지를 누르면 주소뒤에 ?PAGE=1 이 붙는다.  -->
         <!-- if 문으로 1페이지때는 이전 버튼 안넣기 / 마지막 페이지에는 다음 버튼 안넣기 -->
    </main>
</body>
</html>