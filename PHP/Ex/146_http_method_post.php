<?php

// HTTP Method post 요청 데이터를 받는 방법

// $_GET["id"] 이 있을시 데이터 받고 없을시엔 1이 출력(삼향 연산자)
// echo isset($_POST["id"]) ? $_POST["id"] : 1;

var_dump($_POST);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<!-- form태그 작성후 method post으로 감싸기 -->
<!-- post는 무조건 form 태그로 적어야 한다. -->
<!-- post으로 보낼시 서버주소 뒤에 post한 내용이 붙지 않는다. -->
<form action="" method="post">
    <input type="text" name="id" id="id">
    <!-- html 에 있는 name 이  PHP로-->
    <br>
    <button type="submit">버튼</button>
</form>
</body>
</html>