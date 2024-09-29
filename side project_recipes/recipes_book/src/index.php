<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
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
                <a href=""><button class="btn-small content-btn"><</button></a>
                <a href="./detail.html">
                    <div class="list-content">
                        <div class="content-img">
                            <img class="img-insert" src="../img/35614970-과일-디저트.jpg">
                        </div>
                        <div class="list-content-title">제목30</div>
                        <div>작성일자</div>
                        <button class="btn-content">-></button>
                    </div>
                </a>

                <a href="./detail.html">
                    <div class="list-content">
                        <div class="content-img">
                            <img class="img-insert" src="../img/35614970-과일-디저트.jpg">
                        </div>
                        <div class="list-content-title">제목30</div>
                        <div>작성일자</div>
                        <button class="btn-content">-></button>
                    </div>
                </a>

                <a href="./detail.html">
                    <div class="list-content">
                        <div class="content-img">
                            <img class="img-insert" src="../img/35614970-과일-디저트.jpg">
                        </div>
                        <div class="list-content-title">제목30</div>
                        <div>작성일자</div>
                        <button class="btn-content">-></button>
                    </div>
                </a>

                           <a href="./detail.html">
                    <div class="list-content">
                        <div class="content-img">
                            <img class="img-insert" src="../img/35614970-과일-디저트.jpg">
                        </div>
                        <div class="list-content-title">제목30</div>
                        <div>작성일자</div>
                        <button class="btn-content">-></button>
                    </div>
                </a>

                
                <a href=""><button class="btn-small content-btn">></button></a>
            </div>

            <div class="main-footer">
                <a href=""><button class="btn-small">◀</button></a>
                <a href=""><button class="btn-small">1</button></a>
                <a href=""><button class="btn-small">2</button></a>
                <a href=""><button class="btn-small">3</button></a>
                <a href=""><button class="btn-small">4</button></a>
                <a href=""><button class="btn-small">5</button></a>
                <a href=""><button class="btn-small">▶</button></a>
            </div>
        </div>
    </main>
</body>
</html>