<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use MyToken;


class BoardController extends Controller
{
    public function index() {
        $boardList = Board::orderBy('created_at', 'DESC')->paginate(8);  // paginate(n): 한페이지에 가져오고싶은 컨텐츠 갯수

        $responseData = [
            'success' => true
            ,'msg' => '게시글 획득 성공'
            ,'boardList' => $boardList->toArray()
        ];
        
        return response()->json($responseData, 200);
    }

    public function show($id) {     // board.js에 세그먼트 파라미터가 $id가 세그먼트 파라미터
        // join 메소드 : 쿼리 join문(join할 테이블, on할 부분)
        // softDelete를 인식하지 않음, 삭제된 데이터도 가져온다.
        // $board = Board::join('users', 'boards.user_id', '=', 'users.user_id')
        //                 ->select('boards.*', 'users.name')  // 원랜 *을 쓰면 안되고 컬럼들을 다 적어줘야 함!
        //                 // ->where('boards.board_id', '=', $id)
        //                 ->find($id);      // find는 배열안에 값을 넣어줌, get 은 이차원배열에 값을 넣음
        $board = Board::with('user')    // with() : 상위모델에 관련된 하위모델의 모든 데이터를 가져옴
                        ->find($id);
                        // join, n+1문제(많은 통신요청)로 인해 realationship(연관관계)사용
                        
        $responseData = [
            'success' => true
            ,'msg' => '상세 정보 획득 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function store(Request $request) {
        // TODO 유효성체크 넣어주세요.

        // insert data 생성
        $insertData = $request->only('content');
        $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        $insertData['like'] = 0;
        $insertData['img'] = '/'.$request->file('file')->store('img');

        // insert
        $board = Board::create($insertData);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 작성 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
