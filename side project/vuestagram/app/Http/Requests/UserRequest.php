<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    //  authorize() : formRequest를 들어올때 인증을 하는 기능

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    // rules() : validation에 유효성체크 규칙을 적는 곳
    // 컨트롤러에 적지 않아도 validation 체크를 할수있다.
    public function rules()
    {
        $rules = [
            'account' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
            ,'password' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
        ];

        // routeIs('route name') : login인지 아닌지 체크 
        if($this->routeIs('post.login')) {
            $rules['account'][] = 'exists:users,account';
        }

        return $rules;
    }

    // failedValidation : Validation체크가 에러가 났을때 failedValidation 이 자동실행
    protected function failedValidation(Validator $validator){
        $response = response()->json([
            'success' => false,
            'message' => '유효성 체크 오류',
            'data' => $validator->errors()
        ], 422);    // http code를 422로 작성(유효성 체크 오류) 
    
        
        throw new HttpResponseException($response);
    }
}
