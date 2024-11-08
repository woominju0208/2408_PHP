<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function index() {
        // -----------------------
        // 쿼리빌더
        // -----------------------

        // $data =[
        //     'u_email' =>'admin@admin.com'
        // ];

        // 쿼리빌더를 이용하지 않고 SQL 작성
        // 쿼리문을 한줄로 다 쓰는걸 평문작성 이라 한다.
        // select
        $result = DB::select('SELECT * FROM users');
        // 두개가 동일함(키로 해당하냐)
        $result = DB::select('SELECT * FROM users WHERE u_email = :u_email', ['u_email' => 'admin@admin.com']);
        // 두개가 동일함(값을 비워두고 차례대로 적냐)
        $result = DB::select('SELECT * FROM users WHERE u_email = ?', ['admin@admin.com']);

        // insert (url에서 새로고침 한번만 하면 db insert 됌 > 여러번 누르면 에러가 뜸)
        // DB::insert('INSERT INTO boards_category (bc_type, bc_name) VALUES(?, ?)', ['4', '테스트게시판']);

        // update
        // DB::update('UPDATE boards_category SET bc_name = ?  WHERE bc_type = ?',['미어캣게시판', '4']);

        // delete
        // DB::delete('DELETE FROM boards_category WHERE bc_type = ?', ['4']);


        // -----------------------
        // 쿼리 빌더 체이닝
        // -----------------------
        // users 테이블 모든 데이터 조회
        // select * from users;
        $result = DB::table('users')->get();
        
        // 2차원배열이 아닌 1차원 배열이다 , 각 데이터들은 객체들이다
        var_dump($result);
        return '';
    }
}
