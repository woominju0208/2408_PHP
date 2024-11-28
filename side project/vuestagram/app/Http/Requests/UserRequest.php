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
        if($this->routeIs('auth.login')) {
            // 로그인
            $rules['account'][] = 'exists:users,account';
        } else if($this->routeIs('user.store')) {
            // 회원가입
            // [] 배열 하나를 더 적는 이유는 작성한 account 가 위에 account에 맞는지 비교하기 때문에 넣을수 있는 []을 뒤에 하나 적어준 것 
            $rules['account'][] = 'unique:users,account';   // unique, exists 등등 자체가 경로를 찾아가는거라 users.account 는 users에 account가 아니라 users.account라는 테이블을 찾아감
            $rules['password_chk'] = ['same:password'];     // 다른건 위에 비교대상이 하니라 처음 넣는거라 뒤에 []이 없음
            $rules['name'] = ['required', 'between:1,20', 'regex:/^[가-힣]+$/u'];
            $rules['gender'] = ['required', 'regex:/^[0-1]{1}$/'];
            $rules['profile'] = ['required', 'image'];  // min,max로 파일용량도 적용가능(max:2 => 2mb)
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
