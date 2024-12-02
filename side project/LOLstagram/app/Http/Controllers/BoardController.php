<?php

namespace App\Http\Controllers;

use App\Models\Board;
use MyToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function index() {
        // paginate(n): 한페이지에 가져오고싶은 컨텐츠 갯수
        $boardList = Board::orderBy('created_at', 'DESC')->paginate(8);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 획득 성공'
            ,'boardList' => $boardList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function show($id) {
        $board = Board::with('user')->find($id);

        $responseData = [
            'success' => true
            ,'msg' => '상세 정보 획득 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        // insert data 생성
        $insertData = $request->only('content');
        $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        $insertData['like'] = 0;
        $insertData['img'] = '/'.$request->file('file')->store('img');

        if(!($request === 1)) {
            DB::rollBack();
        }
        DB::commit();

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
