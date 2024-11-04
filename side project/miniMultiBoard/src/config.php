<?php
// _는 혹시모를 상수겹침때메 앞에 _ 작성
// 경로
define('_ROOT', $_SERVER['DOCUMENT_ROOT']);
// require_once로 불러오는건 주소 앞에 _ROOT 를 붙여줘야한다.
define('_PATH_VIEW', _ROOT.'/View');
define('_PATH_IMG', '/View/img');


// MariaDB
define('_MARIA_DB_HOST', 'localhost');
define('_MARIA_DB_PORT', '3306');
define('_MARIA_DB_USER', 'root');
define('_MARIA_DB_PASSWORD', 'php504');
define('_MARIA_DB_NAME', 'mini_multi_board');
define('_MARIA_DB_CHARSET', 'utf8mb4');
define('_MARIA_DB_DNS',
        'mysql:host='._MARIA_DB_HOST
        .';port='._MARIA_DB_PORT
        .';dbname='._MARIA_DB_NAME
        .';charset='._MARIA_DB_CHARSET
);





