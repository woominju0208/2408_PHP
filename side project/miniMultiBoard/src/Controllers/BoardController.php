<?php
namespace Controllers;

use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller {
    private $arrBoardList = [];     // 게시글 정보 리스트
    private $boardName = '';        // 게시판 이름

    // getter : 데이터를 가져옴
    public function getArrBoardList() {
        return $this->arrBoardList;
    }
    public function getBoardName() {
        return $this->boardName;
    }

    // setter : 외부로부터 데이터를 전달받아 멤버변수에 저장
    public function setArrBoardList($arrBoardList) {
        $this->arrBoardList = $arrBoardList;
    }
    public function setBoardName($boardName) {
        $this->boardName = $boardName;
    }

    // 멀티 게시판 : 하나의 View형태로 안에 내용을 바꾸면서 여러 게시판을 만듬
    public function index() {
        // 보드타입 획득
        $requestData = [
            'bc_type' => isset($_GET['bc_type']) ? $_GET['bc_type'] : '0'
        ];

        // 게시글 정보 획득
        $boardModel = new Board();
        $this->setArrBoardList($boardModel->getBoardList($requestData));

        // 보드 이름 획득
        $BoardCategoryModel = new BoardsCategory();
        $resultBoardCategory = $BoardCategoryModel->getBoardName($requestData);
        $this->setBoardName($resultBoardCategory['bc_name']);
        

        return 'board.php';
    }
}