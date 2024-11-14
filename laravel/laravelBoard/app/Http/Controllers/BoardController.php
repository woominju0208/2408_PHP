<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

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
    public function create(){    // 작성페이지로 이동 새로운 글 생성(move insert)
        return view('boardInsert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     // 실제로 작성하는 곳(insert)
    {
        // 유효성 검사
        $validator = Validator::make(
            $request->only('b_title', 'b_content', 'file')
                ,[
                    'b_title' => ['required', 'max:50']
                    ,'b_content' => ['required', 'max:200']
                    ,'file' => ['required','image']
                ]
            );

        if($validator->fails()) {
            return redirect()
            ->route('get.boards')
            ->withErrors($validator->errors());
        }

        // 이미지 파일 처리
        if($request->hasFile('file')) {
            $file = $request->file('file');

            // 파일 이름을 저장 (고유 이름으로 저장)
            $imagePath = $file->store('file', 'public');

            $imageRecord = new Image();
            $imageRecord->path = $imagePath;
            $imageRecord->save();

            return back();
        }
        

        // 게시글 작성 처리
         // 데이터베이스 이미지경로 저장
        try{
            DB::beginTransaction();
            $user = Board::create([
                'b_title' => $request->b_title
                ,'b_content' => $request->b_content
                // ,'file' => $request->$imagePath
            ]);
            DB::commit();
        }catch(Throwable $th) {
            DB::rollback();
        }
        // 리턴
        return redirect()->route('boards.index');
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
