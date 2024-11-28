<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 유저관련이기 때문에 폼리퀘스트 사용
    public function store(UserRequest $request) {
        // insert Data 생성
        $insertData = $request->only('account', 'name', 'gender');
        // 비밀번호 암호화
        $insertData['password'] = Hash::make($request->password);
        // 이미지가 public에 profile에 저장되서 경로 삽입 
        $insertData['profile'] = '/'.$request->file('profile')->store('profile');

        // insert 처리
        User::create($insertData);

        // response Data 생성
        $responseData = [
            'success' => true
            ,'msg' => '회원가입 성공'
        ];

        return response()->json($responseData, 200);
    }
}
