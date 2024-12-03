<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    // rules() : validation 유효성 체크 작성
    public function rules()
    {
        // login 유효성 검사
        $rules = [
            'account' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
            ,'password' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
        ];

        // routeIs('route name') : login 인지 아닌지 체크
        if($this->routeIs('auth.login')) {
            // 로그인
            $rules['account'][] = 'exists:users,account';
        } else if($this->routeIs('user.store')) {
            // 회원가입
            $rules['account'][] = 'unique:users,account';
            $rules['password_chk'] = ['same:password'];
            $rules['name'] = ['required', 'between:1,20', 'regex:/^[가-힣]+$/u'];
            $rules['gender'] = ['required', 'regex:/^[0-2]{1}$/'];
            $rules['profile'] = ['required', 'image'];
        } ;

        return $rules;
    }
    
    protected function failedValidation(Validator $validator) {
        $response = response()->json([
            'success' => false,
            'message' => '유효성 체크 오류',
            'data' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
