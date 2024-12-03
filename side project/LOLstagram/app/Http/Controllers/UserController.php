<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserRequest $request) {
        DB::beginTransaction();
        // insert data 생성
        $insertData = $request->only('account','name','gender');
        $insertData['password'] = Hash::make($request->password);
        $insertData['profile'] = '/'.$request->file('profile')->store('profile');

        if(!(count([$request === 1]))) {
            DB::rollBack();
        }
        DB::commit();

        // insert
        User::create($insertData);

        $responseData = [
            'success' => true
            ,'msg' => '회원가입 완료'
        ];

        response()->json($responseData, 200);
    }
}
