<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login 액션 메소드
    public function login(Request $request) {
        // 유저정보 획득
        $userInfo = User::where('account', $request->account)
                            ->withCount('boards')
                            ->first();

        if(!Hash::check($request->password, $userInfo->password)) {
            throw new AuthenticationException('비밀번호 체크 오류');
        }
        // TODO: 토큰 발행, 리프래시 토큰 저장

        $responseData = [
            'success' => true
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
            ,'data' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 로그아웃 처리
}
