<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use MyToken;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login 액션 메소드
    public function login(UserRequest $request) {

        // 유저정보 획득
        $userInfo = User::where('account', $request->account)
                            ->first();

        // 비밀번호 체크
        if(!Hash::check($request->password, $userInfo->password)) {
            throw new AuthenticationException('비밀번호 불일치');
        }
        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);
        // TODO:  리프래시 토큰 저장

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
}
