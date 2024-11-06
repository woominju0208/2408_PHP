<?php
namespace Controllers;

use Lib\Auth;
use Models\BoardsCategory;

// Controller : 부모클래스
// UserController : 자식 클래스
// BoardController : 자식 클래스  
// UserController말고도 다른 Controller도 많이 생긴다.

class Controller {
    // 프로퍼티에 직접 붙어서 사용 > errorMsg 에 가져옴
    protected $arrErrorMsg = [];    // 화면에 표시할 에러 메세지 리스트
    protected $arrBoardNameInfo = []; // 헤더 게시판 드롭다운 리스트
    // protected는 getter setter없이 자식요소에 사용가능
    


    // 생성자
    public function __construct(string $action) {
        // 세션 시작
        // 세션 시작 전 있냐 없냐 체크  1: 안돌아가는중 , 2: 돌아가는중
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 유저 로그인 및 권한체크
        // ::  : class 속 const, static 변수에 접근할 수 있는 연산자.
        Auth::chkAuthorization();

        // 헤더 드롭다운 리스트 획득
        $boardsCategoryModel = new BoardsCategory();
        $this->arrBoardNameInfo = $boardsCategoryModel->getBoardsNameList();

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
