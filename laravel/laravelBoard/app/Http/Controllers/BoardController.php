<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // 많은 부분(여러개의 데이터)들을 보여주는 곳(move list)
    {
        // 리스트 데이터 획득
        // SELECT *
        // FROM boards
        // WHERE deleted_at IS NULL
        // ORDER BY created_at DESC, b_id DESC 
        // ;
        $result = Board::select('b_id', 'b_title', 'b_content', 'b_img',)
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('b_id', 'DESC')
                            ->get();

        return view('boardList')->with('data', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    // 작성페이지로 이동 새로운 글 생성(move insert)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     // 실제로 작성하는 곳(insert)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)       // detail 상세 페이지, 상세데이터를 만들어서 보내줌
    {
        Log::debug('****** boards.show Start ******');
        Log::debug('request id : '.$id);

        $result = Board::find($id);

        Log::debug('획득 상세 데이터', $result->toArray());
        // eloquent model을 배열로 바꾸기 $result->toArray()

        return response()->json($result->toArray());
        // json 의 데이터타입은 []배열이기 때문에 eloquent model 인 $result를 toArray로 배열로 변환해 주었다.
        // toArray를 안적어도 라라벨에서 자동으로 변환해 주지만 적어주는게 좋다.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)       // move update 수정페이지로 이동
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)   // update 수정처리
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)        // delete 삭제처리
    {
        //
    }
}
