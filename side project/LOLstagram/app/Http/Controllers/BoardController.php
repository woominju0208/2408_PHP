<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

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

    // TODO: show, store 메소드 생성
    public function show($id) {
        $board = Board::with('user')->find($id);

        $responseData = [
            'success' => true
            ,'msg' => '상세 정보 획득 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
