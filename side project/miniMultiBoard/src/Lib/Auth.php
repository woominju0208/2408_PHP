<?php

namespace Lib;
// 유저의 접근권한 관련 파일
class Auth {
    public static function chkAuthorization() {
        // 비로그인 시 접속 불가능한 리스트
        // 실제로 arrNeedAuth 이런 접근 불가능한 부분이 있는것도 따로 파일로 빼둔다.(여기엔 같이 적어둠)
        $arrNeedAuth = [
            'boards'
            ,'boards/detail'
            ,'logout'
            ,'boards/insert'
        ];

        $url = $_GET['url'];    // 접속 url 획득

        // 접속 권한이 없는 페이지 접속 차단(로그인 페이지로 이동)
        if(!isset($_SESSION['u_email']) && in_array($url, $arrNeedAuth)) {
            header('Location: /login');
            exit;
        }

        // 로그인한 상태에서 로그인 페이지 접속시 자유게시판으로 이동
        // 로그인한 상태에서 login, regist, localhost url에 입력시 그 페이지로 이동x
        if(isset($_SESSION['u_email']) && !in_array($url, $arrNeedAuth)) {
            header('Location: /boards');
            exit;
        } 
    }
}
// login 페이지일때 배열에 login url이 없기때문에 false