<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에러 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/error.css">
</head>
<body>
    <header>
        <h2>Recipes Book</h2>
        <h1><span>M</span>ake<span>&nbsp;Y</span>our<span>&nbsp;R</span>ecipes</h1>
    </header>
    <main>
        <p>에러가 발생했습니다.</p>
        <p>메인페이지로 되돌아가서 다시 실행해 주세요.</p>
        <p>ERROR: <?php echo $th->getMessage() ?></p>
        <a href="/"><button type="button" class="btn_middle">메인 페이지로</button></a>
    </main>
</body>
</html>