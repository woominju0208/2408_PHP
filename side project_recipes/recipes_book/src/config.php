<?php
// MARIADB 설정
define("MY_MARIADB_HOST", "localhost");   // HOST
define("MY_MARIADB_PORT", "3306");        // PORT
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "php504");
define("MY_MARIADB_NAME", "recipes_book");  // NAME
define("MY_MARIADB_CHARSET", "utf8mb4");  // CHARSET
define("MY_MARIADB_DSN", "mysql:host=".MY_MARIADB_HOST.";port=".MY_MARIADB_PORT.";dbname=".MY_MARIADB_NAME.";charset=".MY_MARIADB_CHARSET);

// 상수 모음
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");   // 웹서버 document root 
define("MY_PATH_DB_LIB", MY_PATH_ROOT."lib/db_lib.php"); // DB 라이브러리
define("MY_PATH_ERROR", MY_PATH_ROOT."error.php");        // 에러 페이지
define("MY_PATH_HEADER", MY_PATH_ROOT."header.php");      // header 상수


define("MY_LIST_CNT", 4);
define("MY_PAGE_BUTTON_CNT", 5);