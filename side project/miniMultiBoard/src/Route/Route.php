<?php
namespace Route;

use Controllers\BoardController;
use Controllers\UserController;
use Models\User;

// 라우트 : 유저의 요청을 분석해서 해당 Controller로 연결해주는 클래스
class Route {
    // 생성자
    public function __construct() {

        $url = isset($_GET['url']) ? $_GET['url'] : '';    
        // 요청 경로 획득 , isset으로 받아오는 url이 있으면 $_GET['url'] 없으면 login페이지 받은 값이 없기 때문에 login페이지로 이동
        $httpMethod = $_SERVER['REQUEST_METHOD'];   // HTTP 메소드 획득
        if($url === '') {
            header('Location: /login');
            exit;
        } else if($url === 'login') {
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
            } else if($url === 'logout') {
                if($httpMethod === 'GET') {
                    new UserController('logout');
                }
            } else if($url === 'regist') {
                // regist 페이지로 이동
                if($httpMethod === 'GET') {
                    new UserController('goRegist');
                } else if($httpMethod === 'POST') {
                    new UserController('regist');
                }
            } else if($url === 'boards/detail') {
                if($httpMethod === 'GET') {
                    new BoardController('show');
                }
            } else if($url === 'boards/insert') {
                if($httpMethod === 'GET') {
                    new BoardController('create');
                } else if($httpMethod === 'POST') {
                    new BoardController('store');
                }
            }
        } 

        // 요청 경로를 체크
    }

// 나에게 construct 가 없으면 부모의 construct를 사용

// show 디테일  index 기본페이지 create 작성페이지 store