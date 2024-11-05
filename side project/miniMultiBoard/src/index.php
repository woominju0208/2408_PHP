<?php
// index 는 엔트리파일로 진입점 (설정파일 불러오기)
require_once('./config.php');   // 설정 파일 불러오기
require_once('./autoload.php');   // 오토로드 파일 불러오기

new Route\Route();  // 라우터 호출 생성자 호출

