<?php

    // HTTP Method GET 요청 데이터를 받는 방법

    // $_GET["id"] 이 있을시 데이터 받고 없을시엔 1이 출력(삼향 연산자)
    // echo isset($_GET["id"]) ? $_GET["id"] : 1;

    var_dump($_GET);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- form태그 작성후 method get으로 감싸기 -->
    <!-- get은 form 태그 없이 주소 뒤에 파라미터(?id=1234) 적어주면 된다. -->
     <!-- get으로 보낼시 서버주소 뒤에 get한 내용이 붙는다. -->
    <form action="" method="get">
        <input type="text" name="id" id="id">
        <!-- html 에 있는 name 이  PHP로-->
        <br>
        <button type="submit">버튼</button>
    </form>
</body>
</html>