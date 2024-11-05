<?php
namespace Route;

use Controllers\BoardController;
use Controllers\UserController;

// 라우트 : 유저의 요청을 분석해서 해당 Controller로 연결해주는 클래스
class Route {
    // 생성자
    public function __construct() {

        $url = $_GET['url'];    // 요청 경로 획득'
        $httpMethod = $_SERVER['REQUEST_METHOD'];   // HTTP 메소드 획득

        // 요청 경로를 체크
        if($url === 'login') {
            // 회원 로그인 관련 / login 페이지로 이동
            if($httpMethod === 'GET') {
                new UserController('goLogin');
                // 회원 로그인 정보 전달
            } else if($httpMethod === 'POST') {
                new UserController('login');
            }
        } else if($url === 'boards') {
            // boards로 페이지 이동
            if($httpMethod === 'GET') {
                new BoardController('index');
            } 
        }
    }
}

// 나에게 construct 가 없으면 부모의 construct를 사용