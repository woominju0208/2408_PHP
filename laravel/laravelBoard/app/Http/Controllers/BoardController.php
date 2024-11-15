<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // 많은 부분(여러개의 데이터)들을 보여주는 곳(move list)
    {
        // 게시글 타입 획득
        $bcType = '0';  // 초기값 설정
        // has : $request에 bc_type이 존재하는지 안하는지
        // $request가 있으면 그 값을 bc_type으로 넣어주기
        if($request->has('bc_type')) {
            $bcType = $request->bc_type;
        }

        // 리스트 데이터 획득
        // SELECT *
        // FROM boards
        // WHERE deleted_at IS NULL
        // ORDER BY created_at DESC, b_id DESC 
        // ;
        $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                            ->where('bc_type', '=' ,$bcType)
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('b_id', 'DESC')
                            ->get();

        // 게시판 이름 획득
        $boardInfo = BoardsCategory::where('bc_type', '=', $bcType)->first();

        return view('boardList')
                ->with('data', $result)
                ->with('boardInfo', $boardInfo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){    // 작성페이지로 이동 새로운 글 생성(move insert)
        return view('boardInsert')->with('bcType', $request->bc_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     // 실제로 작성하는 곳(insert)
    {
        // 유효성 체크
        // $request->validate라는 객체를 사용하면 실패시 무조건 그 전 페이지로 이동한다.
        // 다른 경로로 이동할려면 따로 적어줘야한다.
        $request->validate([
                     'b_title' => ['required', 'between:1,50']
                     ,'b_content' => ['required', 'between:1,200']
                     ,'file' => ['required', 'image']    // image : 이미지 파일만 적용
                     ,'bc_type' => ['required', 'exists:boards_category,bc_type']   // DB에 저장된 bc_type인지 유효성 체크 없으면 에러문구출력 
        ]);
        // $validator = Validator::make(
        //     $request->only('b_title', 'b_content', 'file')
        //     ,[
        //         'b_title' => ['required', 'between:1,50']
        //         ,'b_content' => ['required', 'between:1,200']
        //         ,'file' => ['required', 'image']    // image : 이미지 파일만 적용
        //     ]
        // );

        $filePath = ''; // $filePath 선언 초기화, 에러방지, 선언안했으면 undefine으로 에러처리 생김

        try{
            // 파일저장
            $filePath = $request->file('file')->store('img');   // store('img')로 public에 img 파일로 경로가 생김
            
            // throw new Exception('test');     // test용 강제 에러처리

            DB::beginTransaction();
            // 글 작성 처리
            // 이렇게 변수 처리해서 넣는걸로 만들자 Board::create() 안에 배열로 다 적지 말자
            $insertData = $request->only('b_title', 'b_content', 'bc_type');
            $insertData['b_img'] = '/'.$filePath;
            $insertData['u_id'] = Auth::id();    
            // u_id는 세션에저장된 요소지 유저가 직접 입력한 값이 아니라서 유효성체크 할 필요가 없음
            
            Board::create($insertData);
            DB::commit();
            // route('경로지정', [파라미터 값 출력])
        }catch(Throwable $th) {
            DB::rollBack();
            // 문제가 생겨서 롤백하면 파일저장했던 $filePath경로를 지워주는 처리를 해야 한다.
            // stroage : 설정파일을 public으로 설정 해둠 / 해당파일이 존재하냐 체크, 삭제처리 기능
            if(Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
        
        return redirect()->route('boards.index', ['bc_type' => $request->bc_type]);


        // if($validator->fails()) {
        //     return redirect()
        //                 ->route('boards.create')
        //                 ->withErrors($validator);
        // }

        // ---------------------------------------------------
        // // 유효성 검사
        // $validator = Validator::make(
        //     $request->only('b_title', 'b_content', 'file')
        //         ,[
        //             'b_title' => ['required', 'max:50']
        //             ,'b_content' => ['required', 'max:200']
        //             ,'file' => ['required','image']
        //         ]
        //     );

        // if($validator->fails()) {
        //     return redirect()
        //     ->route('get.boards')
        //     ->withErrors($validator->errors());
        // }
        
        // // 게시글 작성 처리
        //  // 데이터베이스 이미지경로 저장
        // try{
            
        //     $path = $request->file('file')->store('img');
        //     DB::beginTransaction();
        //     $user = Board::create([
        //         'b_title' => $request->b_title
        //         ,'b_content' => $request->b_content
        //         ,'b_img' => $path        // $path앞에 /를 추가해서 db에 저장되어야 함 => ,'b_img' => '/'.$path 
        //         ,'u_id' => Auth::id()   // Auth로 로그인시 pk가 저장 (세션 저장)
        //         ,'bc_type' => '0'       // 임시로 자유게시판 설정
        //     ]);
        //     DB::commit();

        // }catch(Throwable $th) {
        //     DB::rollback();
        // }
        // // 리턴
        // return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)       // detail 상세 페이지, 상세데이터를 만들어서 보내줌
    {
        // Log::debug('****** boards.show Start ******');
        // Log::debug('request id : '.$id);

        $result = Board::find($id);

        $responseData = $result->toArray();
        $responseData['delete_flg'] = $result->u_id === Auth::id();

        // // 처음엔 delete_flg false로 선언
        // $responseData['delete_flg'] = false;
        // // 로그인한 id와 작성자의 작성글 id가 같으면 delete_flg 를 true로 전환(삭제 활성화)
        // if($result->u_id === Auth::id()) {
        //     $responseData['delete_flg'] = true;
        // }

        // Log::debug('획득 상세 데이터', $result->toArray());
        // eloquent model을 배열로 바꾸기 $result->toArray()

        return response()->json($responseData);
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
    // destroy라는 엘로퀀트 모델이 softdelete로 설정해놔서 db에 삭제일자만 찍히는 거임
    {
        $result = Board::destroy($id);
        // destroy 는 성공(true)일시 무조건 1을 보내줌
        // 1이 아닌 0 이나 2,3 등등 이면 실패처리

        $responseData = [
            'success' => $result === 1 ? true : false
        ];

        return response()->json($responseData);
    }
}
