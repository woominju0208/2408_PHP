<?php
namespace Models;

use PDO;
use Throwable;

class Model {
    protected $conn;    // PDO 객체 저장용

    // 생성자
    public function __construct() {
        try {
            $opt = [
                PDO::ATTR_EMULATE_PREPARES      => false    // DB의 Prepare Statment 기능을 사용하도록 설정
                ,PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION   // PDO Exception을 throws 하도록 설정
                ,pdo::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC     // 연관 배열로 fetch 설정
            ];

            $this->conn = new PDO(_MARIA_DB_DNS, _MARIA_DB_USER, _MARIA_DB_PASSWORD, $opt);
        } catch(Throwable $th) {
            echo 'Model->__construct(), '.$th->getMessage();
            exit;
        }
    }

    // 트랜잭션 시작
    public function beginTransaction() {
        $this->conn->beginTransaction();
    }

    // 커밋
    public function commit() {
        $this->conn->commit();
     }

    //  롤백
    public function rollBack() {
        $this->conn->rollBack();
    }
    // 각 예외처리들은 자식객체 안에서 하고 부모객체인 Model에서는 트랜잭션, 커밋, 롤백요소만 적어준다.
}
