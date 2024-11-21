<?php
// JWT token 만들기
namespace App\Utils;

use App\Models\User;
use App\Utils\MyEncrypt as UtilsMyEncrypt;
use MyEncrypt;

class MyToken {
    /**
     * 액세스 토큰과 리프래시 토큰 생성
     * 
     * @param App\Models\User $user
     * @return Array [$accessToken, $refreshToken]
     */
    public function createTokens(User $user) {
        $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));  // true는 default라서 작성 안해도 무관
        $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'), false);

        return [$accessToken, $refreshToken];
    }
    
    /**
     * JWT 생성
     * 
     * @param App\Models\User $user
     * @param int $ttl
     * @param bool $accessFlg = true
     * ttl: time to limit
     * 
     * @return string JWT   
     */
    private function createToken(User $user, int $ttl, bool $accessFlg = true) {
        $header = $this->createHeader();
        $payload = $this->createPayload($user, $ttl, $accessFlg);
        $signature = $this->createSignature($header, $payload);     // header,paylode를 합쳐서 만듬

        return $header.'.'.$payload.'.'.$signature;
    }

    /**
     * JWT Header 생성
     * 
     * @return string base64UrlEncode
     */
    private function createHeader() {
        $header = [
            // TOKEN 에서 사용하는 요소는 3글자 약어로 사용
            'alg' => env('TOKEN_ALG')
            ,'typ' => env('TOKEN_TYPE')
        ];

        return MyEncrypt::base64UrlEncode(json_encode($header));
    }

    /**
     * JWT Payload 작성
     * 
     * @param App\Models\User $user
     * @param int $ttl
     * @param bool $accessFlg = true
     * 
     * @return string base64Payload
     */

     private function createPayload(User $user, int $ttl, bool $accessFlg = true) {
        $now = time();  // 현재 시간

        // Payload 기본 데이터 생성
        $payload =[
            'idt' => $user->user_id
            ,'iat' => $now
            ,'exp' => $now + $ttl
            ,'ttl' => $ttl
        ];

        // 액세스 토큰일 경우 아래 데이터 추가
        if($accessFlg) {
            $payload['acc'] = $user->account;
        }

        return MyEncrypt::base64UrlEncode(json_encode($payload));
     }

    /**
     *  JWT Signature 작성
     * 
     * @param string $header base64encode
     * @param string $payload base64encode
     * 
     * @return string base64Signature
     */

     private function createSignature(string $header, string $payload) {
        return MyEncrypt::hashWithSalt(
            env('TOKEN_ALG')
            ,$header.env('TOKEN_SECRET_KEY').$payload
            ,MyEncrypt::makeSalt(env('TOKEN_SALT_LENGTH'))
        );
     }
}