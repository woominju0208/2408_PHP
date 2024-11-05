<?php
namespace Models;

use Models\Model;
use Throwable;

class User extends Model {
    public function getUserInfo($paramArr) {
        try {
            $sql =
                ' SELECT * '
                .' FROM users'
                .' WHERE u_email = :u_email '
             ;
            $stmt = $this->conn->prepare($sql); // 쿼리준비
            $stmt->execute($paramArr);
            // 힌 데이터 처리 => fetch
            return $stmt->fetch();

        }catch(Throwable $th) {
            echo 'User->getUserInfo(), '.$th->getMessage();
            exit;
        }
    }
}