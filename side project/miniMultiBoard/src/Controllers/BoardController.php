<?php
namespace Controllers;

use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller {
    private $arrBoardList = [];     // 게시글 정보 리스트
    private $boardName = '';        // 게시판 이름
    protected $boardType = '';      // 게시판 코드

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
        $this->boardType = $requestData['bc_type'];

        // 게시글 정보 획득
        $boardModel = new Board();
        $this->setArrBoardList($boardModel->getBoardList($requestData));

        // 보드 이름 획득
        $BoardCategoryModel = new BoardsCategory();
        $resultBoardCategory = $BoardCategoryModel->getBoardName($requestData);
        $this->setBoardName($resultBoardCategory['bc_name']);
        

        return 'board.php';
    }
    // 상세페이지
    public function show() {
        $requestData = [
            'b_id' => $_GET['b_id']
        ];

        // 게시글 정보 조회
        $boardModel = new Board();
        $resultBoard = $boardModel->getBoardDetail($requestData);

        // JSON 변환
        // Ajax를 사용하는데 거기에 axios라는 라이브러리를 사용하고 JSON형태로 데이터를 보내줄것이다.
        $responseData = json_encode($resultBoard);

        // json타입으로 보냈다는걸 명시해주는 문법(이대로 적어야함) 
        header('Content-type: application/json');   // 데이터 타입을 json파일로 보내준다는 의미
        echo $responseData;
        exit;
    }

    // 작성 페이지로 이동
    public function create() {
        $this->boardType = $_GET['bc_type'];
        return 'insert.php';
    }

    // 작성 처리
    public function store() {
        $requestData = [
            'b_title' => $_POST['b_title']
            ,'b_content' => $_POST['b_content']
            ,'b_img' => ''
            ,'bc_type' => $_POST['bc_type']
            ,'u_id' =>  $_SESSION['u_id']
        ];

        $requestData['b_img'] = $this->saveImg($_FILES['file']);

        $boardModel = new Board();
        $boardModel->beginTransaction();
        $resultBoardInsert = $boardModel->insertBoard($requestData);
        if($resultBoardInsert !== 1) {
            $boardModel->rollBack();
            $this->arrErrorMsg[] = '게시글 작성 실패';
            // 이걸 넣지않으면 hidden으로 보내온 bc_type값이 없이올거라 타입 설정
            $this->boardType = $requestData['bc_type'];
            return  'insert.php';
        }

        $boardModel->commit();

        return 'Location: /boards?bc_type='.$requestData['bc_type'];
    }

    // 이미지업로드시 이름 랜덤 변경후 db저장
    private function saveImg($file) {
        $type = explode('/', $file['type']);    // ['IMAGE', '확장자']
        $fileName = uniqid().'.'.$type[1];      // 2kh232kjkj2323.확장자
        $filePath = _PATH_IMG.'/'.$fileName;    //  /view/img/2kh232kjkj2323.확장자
        move_uploaded_file($file['tmp_name'], _ROOT.$filePath);     // 파일복사

        return $filePath;
    }
}