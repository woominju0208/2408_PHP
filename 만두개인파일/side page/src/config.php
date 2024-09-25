<?php

// 공통적으로 사용하는 데이터베이스 설정파일(상수적용)
// ** MariaDB 설정 **
define("MY_MARIADB_HOST", "localhost");   // HOST
define("MY_MARIADB_PORT", "3306");        // PORT
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "mandu0208");
define("MY_MARIADB_NAME", "mini_board");  // NAME
define("MY_MARIADB_CHARSET", "utf8mb4");  // CHARSET
define("MY_MARIADB_DSN", "mysql:host=".MY_MARIADB_HOST.";port=".MY_MARIADB_PORT.";dbname=".MY_MARIADB_NAME.";charset".MY_MARIADB_CHARSET);
// 상수명이 겹치는걸 막기위해 상수에 MY_작성
// 부분 드래그 후 ctrl + shift + l 전체 선택


// ** PHP Path관련 설정 **
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");   // 웹서버 document root 
define("MY_PATH_DB_LIB", MY_PATH_ROOT."lib/db_lib.php"); // DB 라이브러리
define("MY_PATH_ERROR", MY_PATH_ROOT."error.php");        // 에러 페이지

// $_SERVER["DOCUMENT_ROOT"] = C:/Apache24/htdocs
// MY_PATH_ROOT."lib/db_lib.php" = C:/Apache24/htdocs/lib/db_lib.php
// 각자 파일들이 다른 위치에 있어서 상대경로로는 파일 위치를 알기 힘들다 $_SERVER이란 슈퍼전역변수가 절대경로를 찾아준다.
// $_대문자로 된 변수를 슈퍼 글로벌 변수라 한다.($_SERVER)

// 엄청 많은 여러 파일 에 이 설정들을 적용해야해서 상수로 적용해 수정사항이 생긴다
// 상수설정이 없으면 모든 php파일에 수정/ 오타의 확률이 크기 때문에
// 그럼 공통파일인 config만 수정하면 되기 때문에 필수요소이고 유지보수 측면이 매우 좋다.

// ** 로직 관련 설정 **
define("MY_LIST_COUNT", 3);
define("MY_PAGE_BUTTON_COUNT", 5);