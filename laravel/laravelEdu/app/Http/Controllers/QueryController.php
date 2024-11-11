<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QueryController extends Controller
{
    public function index(Request $request) {
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
        // get메소드 : 쿼리 실행 메소드

        // select * from users where name =? ['관리자']
        // where('where조건컬럼', '연산자', '값')
        $result = DB::table('users')
                            ->where('u_name', '=', '관리자')
                            ->get();


        // select * from boards where bc_type = ? and b_id < 15 ? ['0', 15]
        // where 조건을 and 로 적을땐 계속 where()를 적어주면 된다. 
        $result = DB::table('boards')
                                ->where('bc_type', '=', '0')
                                ->where('b_id', '<', 15)
                                ->get();


        // select * from boards where bc_type = ? or b_id < 15 ? ['0', 15]
        // where 조건을 or 로 적을땐 orWhere()를 적어주면 된다.
        $result = DB::table('boards')
                                ->where('bc_type', '=', '0')
                                ->orWhere('b_id', '<', 15)
                                ->get();

        // select b_title, b_content from boards where b_id in (?, ?) [11, 12]
        // where 조건을 in 으로 적을땐 select('컬럼이름')->WhereIn()를 적어주면 된다.
        $result = DB::table('boards')
                            ->select('b_title', 'b_content')
                            ->whereIn('b_id', [11, 12])
                            ->get();


        // select * from where deleted_at is null
        // 해당컬럼의 null을 체크 할 수 있다.
        $result = DB::table('boards')
                            ->whereNull('deleted_at')
                            ->get();

            
        // select * from users where YEAR(created_at) = ? ['2024']
        // YEAR 로 데이터를 많이 돌아 속도저하될 가능성 큼
        // 이런식으로 속도저하를 막기위해 쿼리 튜닝을 가짐
        // SELECT *
        // FROM users
        // WHERE created_at >= '2024-01-01 00:00:00'
        //     AND created_at <= '2024-12-31 23:59:59';
        $result = DB::table('users')
                        ->whereYear('created_at', '=', '2024')
                        ->get();
                        
        // 이런식으로 수정
        $result = DB::table('users')
                        ->where('created_at', '>=', '2024-01-01 00:00:00')
                        ->Where('created_at', '<=', '2024-12-31 23:59:59')
                        ->get();

        // dd()로 평문 출력가능 
        // dd 메소드는 컬렉션의 아이템을 덤프하여 표시하고 스크립트를 종료               
        // $result = DB::table('users')
        //                 ->where('created_at', '>=', '2024-01-01 00:00:00')
        //                 ->Where('created_at', '<=', '2024-12-31 23:59:59')
        //                 ->dd();

        // 게시판별 게시글 갯수
        // DB::raw : 전달할려는 DB 함수를 그대로 쓸수있게 해줌
        // groupBy() : groupby 함수
        // having()  : groupby 함수의 조건을 넣을수 있는 함수
        // whereNull : 해당 컬럼 조건이 null값인걸 찾음
        // SELECT COUNT(*) cnt
		// ,bc_type
        // FROM boards
        // WHERE deleted_at IS NULL
        // GROUP BY bc_type;
        $result = DB::table('boards')
                        ->select('bc_type', DB::raw('COUNT(*) cnt'))    // DB:raw를 많이 쓰면 DB전환 작업에서 오류가 날수 있다. 
                        ->whereNull('deleted_at')
                        ->groupBy('bc_type')
                        ->having('bc_type', '=', '0')
                        ->get();


        // select b_id, b_title from boards order by b_id limit ? offset ? [1, 2]
        // orderBy : 올림차순, 내림차순 디폴트는 올림차순(asc)
        // limit()  : 값갯수 까지
        // offset() : 해당 갯수 이후부터
        $result = DB::table('boards')
                        ->select('b_id', 'b_title')
                        ->orderBy('b_id', 'ASC')
                        ->limit(1)
                        ->offset(2)
                        ->get();


        // Conditional - where절  when($role, $callBack) : $role이 존재하는 경우에만 where 실행
        // 동적쿼리 => 해당 조건을 만족할때만 실행
        $requestData = [
            'u_id' => 4
        ];
        // null, false, 0, '', [] 의 경우에 when 조건이 실행되지 않는다.(빈 처리)
        $result = DB::table('users')
                        ->when($requestData['u_id'], function($query, $u_id) {
                            $query->where('u_id', '=', $u_id);
                        })
                        ->get();
                        // $requestData에 u_id가 있으면 $query->where() 실행 u_id가 없으면 실행하지 않는다.

        
        // 삭제되지 않은 글 중에 제목에 자유 또는 질문이 포함되어 있는 게시글 검색
        // SELECT *
        // FROM boards
        // WHERE
        //     (b_title LIKE '%자유%'
        //     OR b_title LIKE '%질문%')
        //     AND deleted_at IS null
        // ;
        $result = DB::table('boards')
                        ->whereNull('deleted_at')
                        ->where(function($query) {
                            $query->where('b_title', 'like', '%자유%')
                                    ->orWhere('b_title', 'like', '%질문%');
                        })
                        ->get();
                        // $query 에는 where절을 실행하기전까지 쿼리빌더(쿼리를 만드는 과정)의 정보가 들어간다. => DB::table('boards') ~


        // first() : 쿼리 결과 중에 첫번째 레코드만 반환
        $result = DB::table('users')->first();

        // find($id) : 지정된 pk에 해당하는 레코드를 반환
        // $result = DB::table('users')->find(1);

        // count() : 쿼리 결과의 레코드 수를 반환(int 반환)
        $result = DB::table('users')->count();


        // ---------------------------------------------------------
        // insert
        // $result에 바로 insert 처리
        // $result = DB::table('users')
        //                 ->insert([
        //                     'u_email' => 'kim@admin.com'
        //                     ,'u_password' => Hash::make('qwer1234')
        //                     ,'u_name'  =>'김영희'
        //                 ]);

        // $arr 배열에 insert할 값 넣고 $result에 배열 $arr를 insert 처리
        $arr = [
            'u_email' => 'kim@admin.com'
            ,'u_password' => Hash::make('qwer1234')
            ,'u_name'  =>'김영희'
        ];
        // $result = DB::table('users')
        //                 ->insert($arr);

        
        // update   : 조건(where) 필수
        // $result = DB::table('users')
        //                 ->where('u_id', '=', '7')
        //                 ->update([
        //                     'u_name' => '김철수'
        //                 ]);


        // delete
        // $result =DB::table('users')
        //             ->where('u_id', '=', 7)
        //             ->delete();

        // --------------------------------------------------
        // Eloquent Model
        // --------------------------------------------------
        // $result = DB::table('users')->get();
        $result = User::where('u_name', '=', '만두두')->first();
        // $result = User::find(1);
        // 모델명 User의 복수명인 테이블인 users에 세팅
        // $result->u_name = '테스트';
        // attributes : 변경된 부분(DB엔 적용X)
        // original : 원래 DB안 기본 데이터


        // Insert
        // index 클래스의 파라미터로 $request 보냄
        // url창에 u_email,u_password,u_name 로 적으면 attributes에 적은 내용이 찍힘
        // $userInsert = new User();
        // $userInsert->u_email = $request->u_email;
        // $userInsert->u_password = Hash::make($request->u_password);
        // $userInsert->u_name = $request->u_name;
        // // save() 함수로 url에 넣으면 attributes가 original로 들어가서 DB에 새로운 데이터가 들어간다.
        // $userInsert->save();


        // // Update
        // $userUpdate = User::find(8);
        // $userUpdate->u_name = '김철수철수';
        // $userUpdate->save();

        // Delete
        // softdelete로 deleted_at 값이 찍힌다.
        // destroy($id) : 해당 id의 모델을 삭제
        // $userDelete = User::destroy(9);

        // 삭제된 데이터도 포함해서 검색하고 싶을 때
        // withTrashed() : 삭제포함
        $result = User::withTrashed()->count();

        // 삭제된 데이터만 검색하고 싶을 때
        // onlyTrashed() : 삭제만 포함
        $result = User::onlyTrashed()->count();

        // 삭제된 데이터를 되살리고 싶을 때(연산자 '='만 생략가능)
        $result = User::where('u_id', 8)->restore();

        // 2차원배열이 아닌 1차원 배열이다 , 각 데이터들은 객체들이다
        // var_dump($userInsert);
        var_dump($result);
        return '';
    }
}
