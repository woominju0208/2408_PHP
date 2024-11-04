<?php
namespace Controllers;

// Controller : 부모클래스
// UserController : 자식 클래스 
// UserController말고도 다른 Controller도 많이 생긴다.

class Controller {
    // 생성자
    public function __construct(string $action) {
        // 세션 시작

        // 유저 로그인 및 권한체크

        // 해당 Action 호출
        $resultAction = $this->$action();   // goLogin 함수 호출
        // echo $resultAction;                 // login.php 출력

        // view 호출
        $this->callView($resultAction);

        exit;   // php 처리 종료
    }

    /**
     * 뷰 or 로케이션 처리용 메소드
     */
    private function callView($path) {
        // 제일 첫번째 만들어지는건 0 있으면 0이 있다고 찍히고 없으면 안찍힐것이다
        if(strpos($path, 'Location:') === 0) {
            header($path);
        } else {
            require_once(_PATH_VIEW.'/'.$path);
        }
    }
}
