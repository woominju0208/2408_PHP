<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyToken;

class AuthController extends Controller
{
    // action method login 생성 => form request 사용
    public function login(UserRequest $request) {
        // 유저정보 획득
        // 라라벨 relationship 이용 => withCount
        $userInfo = User::where('account', $request->account)
                            ->withCount('boards')   // board는 user.php 에 있는 것
                            ->first();

        // 비밀번호 체크
        if(!(Hash::check($request->password, $userInfo->password))) {
            throw new AuthenticationException('비밀번호 체크 오류');     // 로그인관련 오류 메세지
            // AuthenticationException을 사용하면 최종적으로 app/Exceptions/Handler 에 있는걸 처리
        }

        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // 리프래시 토큰 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);  // (유저모델, 리프래시 토큰) 

        $responseData = [
            'success' => true
            ,'msg' => '로그인 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
            ,'data' => $userInfo->toArray()
        ];

            
        // 리프레쉬 토큰
        return response()->json($responseData, 200);
    }

    /**
     * 로그아웃
     * 
     * @param Illuminate\Request $request
     * 
     * @return response JSON
     */
    // 기존에 이상한 use를 사용하면 새로 선택한 Request에 as 해서 다른 별칭이 붙어서 다른거 선택안하게 조심
    public function logout(Request $request) {
        // 페이로드에서 유저 id 획득
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');   // 'idt' => payload에 id

        DB::beginTransaction();

        // 유저 정보 획득
        $userInfo = User::find($id);

        // 리프래시 토큰 갱신
        MyToken::updateRefreshToken($userInfo, null);

        DB::commit();

        $responseData = [
            'success' => true
            ,'msg' => '로그아웃 성공'
        ];

        return response()->json($responseData, 200);
    }
}
