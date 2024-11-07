<?php
namespace Controllers;

// 인스턴스화 하면 use 가 들어가 있어야 한다.
use Controllers\Controller;
use Lib\UserValidator;
use Models\User;

class UserController extends Controller {
    // 이메일,이름의 빈문자열을 선언 
    protected $userInfo = [
        'u_email' => ''
        ,'u_name' => ''
    ];


    protected function goLogin() {
        return 'login.php';
    }

    protected function login() {
        //  유저 입력 정보를 획득
        $requestData = [
            'u_email' => $_POST['u_email']
            ,'u_password' => $_POST['u_password']
        ];

        // 유효성 체크
        $resultValidator = UserValidator::chkValidator($requestData);
        if(count($resultValidator) > 0) {
            $this->arrErrorMsg = $resultValidator;
            return 'login.php';
        }

        // 유저정보를 획득
        $userModel = new User();
        $prepare = [
            'u_email' => $requestData['u_email']
        ];
        $resultUserInfo = $userModel->getUserInfo($prepare);

        // var_dump($resultUserInfo);
        // var_dump(password_hash($requestData['u_password'], PASSWORD_DEFAULT));
        // exit;

        
        // 유저 존재 유무 유효성 체크
        if(!$resultUserInfo) {
            $this->arrErrorMsg[] = '존재하지 않는 유저입니다.';
            return 'login.php';     // 에러메세지는 login 페이지로 돌아가 출력
            // 비밀번호가 일치한지 아닌지 체크 일치하지 않으면 에러메세지 출력
        } else if(!password_verify($requestData['u_password'], $resultUserInfo['u_password'])) {
            // 패스워드 체크
            $this->arrErrorMsg[] = '패스워드가 일치하지 않습니다.';
            return 'login.php';     // 에러메세지는 login 페이지로 돌아가 출력
        }
        
        // 세션에 u_id 저장
        $_SESSION['u_id'] = $resultUserInfo['u_id'];
        $_SESSION['u_email'] = $resultUserInfo['u_email'];
        
        // 로케이션 처리
        // 단순 view열기가 아닌 다른 페이지로 이동
        return 'Location: /boards';
    }

    // 로그아웃 처리
    public function logout() {
        unset($_SESSION['u_id']);    // 유저 아이디 제거
        unset($_SESSION['u_email']);    // 유저 이메일 제거
        session_destroy();              // 세션 파기

        return 'Location: /login';         // login 페이지로 이동
    }

    // 회원가입페이지로 이동
    public function goRegist() {
        return 'regist.php';
    }

    // 회원가입 처리
      public function regist() {
        $requestData = [
            'u_email' => isset($_POST['u_email']) ? $_POST['u_email'] : ''
            ,'u_password' =>  isset($_POST['u_password']) ? $_POST['u_password'] : ''
            ,'u_password_chk' => isset($_POST['u_password_chk']) ? $_POST['u_password_chk'] : ''
            ,'u_name' => isset($_POST['u_name']) ? $_POST['u_name'] : ''
        ];
        // 유저가 회원가입시 보낸 이메일,이름 저장후 재출력 해줌
        $this->userInfo = [
            'u_email' => $requestData['u_email']
            ,'u_name' => $requestData['u_name']
        ];

        // 유효성 체크
        $resultValidator = UserValidator::chkValidator($requestData);
        if(count($resultValidator) > 0) {
            $this->arrErrorMsg = $resultValidator;
            return 'regist.php';
        }

        // 이메일이 있는지 없는지 중복 체크
        $userModel = new User();
        $prepare = [
            'u_email' =>$requestData['u_email']
        ];
        $resultUserInfo = $userModel->getUserInfo($prepare);
        if($resultUserInfo) {
           $this->arrErrorMsg[] = '이미 가입된 이메일 입니다.';
           return 'regist.php';
        }

        // 회원 정보 인서트
        $userModel ->beginTransaction();
        $prepare = [
            'u_email' => $requestData['u_email']
            ,'u_password' => password_hash($requestData['u_password'], PASSWORD_DEFAULT)
            ,'u_name' => $requestData['u_name']
        ];
        $resultRegistUserInfo = $userModel->registUserInfo($prepare);
        // 회원가입 들어온 정보가 1개가 아닐시 롤백
        if($resultRegistUserInfo !== 1) {
            $userModel->rollBack();
            $this->arrErrorMsg[] = '회원가입에 실패했습니다.';
            return 'regist.php';
        }
        // 1개 들어올시 커밋
        $userModel->commit();
        // 로그인페이지로 리턴
        return 'Location: /login';

    }
    // return 'login.php'; 와 return 'Location: /login'; 차이
    // Controller에  뷰 or 로케이션 처리용 메소드 규칙에 따름
}

// // 비밀번호 암호화
// $encryptPassword = password_hash($requestData['u_password'], PASSWORD_DEFAULT);
// password_verify('12345', $encryptPassword); // 비밀번호가 같은지 확인
