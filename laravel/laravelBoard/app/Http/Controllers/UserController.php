<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends Controller
{
    /**
     * 로그인 페이지
     */
    public function goLogin() {
        return view('login');
    }

    /**
     * 로그인 처리
     */
    public function login(Request $request) {
        Log::debug('리퀘스트 데이터',  $request->only('u_email', 'u_password'));
        // 유효성 체크
        // Validator : 검증
        // make 에 $data, $rules 둘다 배열로 줘야함
        $validator = Validator::make(
            // $request->only('key'...) : 해당하는 키들을 연관 배열로 가져옴
            $request->only('u_email', 'u_password')
            ,[
                'u_email' => ['required', 'exists:users,u_email', 'email']  // exists : 존재하는지 존재하지 않는지 체크
                // ['required'] 필수요소  'email' 은 @ 정도만 체크해서 정규식적는걸 추천 
                ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']    // regex에 + 필수
                // min는 ~개수이상, max 는 ~개수이하 제한을 둠 , regex: 정규식
                // html input required와 별개로 백엔드에서도 있는지 없는지 유효성체크를 해야함
            ]
        );

        if($validator->fails()) {   // validator 에 fails 객체 실패하면 true처리 아니면 false
            // redirect() : 다른 페이지로 넘어갈때 사용(라라벨 문법) php Location 과 같음
            return redirect()
                    ->route('goLogin')
                    ->withErrors($validator->errors());
        }

        // 회원 정보 획득
        $userInfo = User::where('u_email', '=', $request->u_email)->first();

        // 비밀번호 체크
        // 해쉬화 비밀번호가 요청한 값과 저장된 정보값이 같은지 체크 다르면 에러사항출력
        if(!(Hash::check($request->u_password, $userInfo->u_password))) {
            return redirect()
                    ->route('goLogin')
                    ->withErrors('비밀번호가 일치하지 않습니다.');

                    // header('Location: /');
                    // exit;
        }

        // 유저 인증 처리
        // Auth::login : 로그인 처리후 세션이 알아서 설정 
        Auth::login($userInfo);
        // var_dump(Auth::id());       // 로그인한 유저의 pk 획득
        // var_dump(Auth::user());     // 로그인한 유저의 정보 획득
        // var_dump(Auth::check());    // 로그인 여부 체크


        // 로그인 처리후 세션생성후 로그인후 보드페이지로 가며 쿠키도 같이 생성됨
        return redirect()->route('boards.index');   // resource로 만들어서 이름이 boards.index
    }

    /**
     * 로그아웃 처리(적힌사항 전부 필수!)
     */
    public function logout() {
        Auth::logout();     // 로그아웃 처리
        // 보안상 처리
        Session::invalidate();  // 기존 세션의 모든데이터 제거 및 새로운 세션 ID 발급
        Session::regenerateToken(); // CSRF 토큰 재발급

        return redirect()->route('goLogin');    // 로그인페이지로 이동
    }


    // // 회원가입 이동
    // public function regist() {
    //     return view('regist');
    // }

    // // 회원가입 처리
    // public function makeAccount(Request $request) {
    //     // 요청 데이터 유효성 검사
    //     $validator = Validator::make(
    //         $request->only('u_email', 'u_password', 'u_name', 'chk_password')
    //         ,[
    //             'u_email' => ['required', 'unique:users,u_email', 'email']
    //             ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
    //             ,'chk_password' => ['required', 'same:u_password']
    //             ,'u_name' => ['required', 'min:2', 'regex:	/^[a-zA-Z가-힣0-9]+$/']
    //         ]
    //         );
    
    //         // 유효성 검사 실패시 오류 반환
    //         if($validator->fails()) {
    //             return redirect()
    //                     ->route('regist')
    //                     ->withErrors($validator->errors());
    //         }

    //         // DB 트랜잭션
    //         // DB::transaction(function ($request) {
    //         //     User::create([
    //         //         'u_email' => $request->u_email
    //         //         ,'u_password' => Hash::make($request->u_password)
    //         //         ,'u_name' => $request->u_name
    //         //     ]);   
    //         // }); 

    //         DB::beginTransaction();

    //         try{
    //             // 새로운 데이터 DB저장 처리
    //             $user = User::create([
    //                 'u_email' => $request->u_email
    //                 ,'u_password' => Hash::make($request->u_password)
    //                 ,'u_name' => $request->u_name
    //             ]);

    //             DB::commit();
                
    //         }catch(Throwable $th){
    //             DB::rollBack();
    //         }
            
    //         // 리턴
    //         return redirect()->route('login');
    // }

    /**
     * 회원가입 페이지로 이동
     */
    public function registration() {
        return view('registration');
    }

    /**
     * 회원가입 처리
     */
    public function storeRegistration(Request $request) {
        // 유효성 체크
        $validator = Validator::make(
            $request->only('u_email', 'u_password', 'u_password_chk', 'u_name')
                ,[
                    'u_email' => ['required', 'unique:users,u_email', 'email']  // exists : 존재하는지 존재하지 않는지 체크
                    ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']    // regex에 + 필수
                    ,'u_password_chk' => ['same:u_password']        // required 할 필요없음
                    ,'u_name' => ['required', 'between:2,50', 'regex:/^[가-힣]+$/u']    // regex에 u를 붙여줘야 한글을 제대로 읽음 필수
                ]
        );

        if($validator->fails()) {   // validator 에 fails 객체 실패하면 true처리 아니면 false
            // redirect() : 다른 페이지로 넘어갈때 사용(라라벨 문법) php Location 과 같음
            return redirect()
                    ->route('get.registration')
                    ->withErrors($validator->errors())
                    ->withInput();
        }
        // 회원 정보 삽입
        // $user = new User();
        // $user->u_email = $request->u_email;
        // $user->u_password = $request->u_password;
        // $user->u_name = $request->u_name;
        // $user->save();

        try{
            DB::beginTransaction();
            // $user는 나중에 받은 데이터가 필요로 할때 받아서 사용하고 지금은 쓸 필요는 없다.
            // User::create는 User 모델을 쓰겠다는거고 모델에 화이트리스트가 적혀 있어야 create를 쓸수 있다.
            $user = User::create([
                'u_email' => $request->u_email
                ,'u_password' => Hash::make($request->u_password)
                ,'u_name' => $request->u_name
            ]);
            DB::commit();
        } catch(Throwable $th) {
            // 에러핸들러 배우고 난 후 에러처리 삽입 
            DB::rollBack();
        }

        return redirect()->route('goLogin');
    }

}
// route에 클로져(function() { })와 똑같이 컨트롤러에서도 쓰면 된다.

// 회원가입시 기존 있는 이메일만 넘어감 
// 비밀번호 확인 처리
// 회원가입이 되지 않음