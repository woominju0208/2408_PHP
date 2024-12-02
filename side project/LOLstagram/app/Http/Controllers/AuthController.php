<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use MyToken;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login 액션 메소드
    public function login(UserRequest $request) {

        // 유저정보 획득
        $userInfo = User::where('account', $request->account)
                            ->withCount('boards')
                            ->first();

        // 비밀번호 체크
        if(!Hash::check($request->password, $userInfo->password)) {
            throw new AuthenticationException('비밀번호 불일치');
        }
        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);
        // 리프래시 토큰 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);

        $responseData = [
            'success' => true
            ,'msg' => '로그인 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
            ,'data' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 로그아웃 처리
    public function logout(Request $request) {
        // 페이로드에서 유저 id획득
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        DB::beginTransaction();
        // 유저 정보 획득
        $userInfo = User::find($id);

        // 리프래시 토큰 갱신
        MyToken::updateRefreshToken($userInfo, null);
        
        // 커밋
        DB::commit();

        $responseData = [
            'success' => true
            ,'msg' => '로그아웃 성공'
        ];

        return response()->json($responseData, 200);
    }


    
    // 토큰 재발급 처리
    public function reissue(Request $request) {
        // 페이로드에서 유저 id획득
        $userId = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        // 유저정보 획득
        $userInfo = User::find($userId);

        // 리프래시 토큰 비교 (유저가 보낸 리프래시랑 저장된 리프래시)
        if($request->bearerToken() !== $userInfo->refresh_token) {
            throw new MyAuthException('E22');
        }

        // 토큰 발급
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // 리프래시 토큰 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);

        $responseData = [
            'success' => true
            ,'msg' => '토큰 재발급 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
        ];

        return response()->json($responseData, 200);
    }
}
