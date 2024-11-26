<?php
// JWT token 만들기
namespace App\Utils;

use App\Exceptions\MyAuthException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MyEncrypt;
use PDOException;

class MyToken {

    // ----------------------------------- 
    // public
    // ----------------------------------- 

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
     * 리프래시 토큰 업데이트
     * 
     * @param App\Model\User $userInfo 유저정보
     * @param string $refreshToken
     * 
     * @return bool true
     */
    public function updateRefreshToken(User $userInfo, string|null $refreshToken) {
        // 유저 모델에 리프래시 토큰 변경
        $userInfo->refresh_token = $refreshToken;

        if(!($userInfo->save())) {
            DB::rollBack();
            throw new PDOException('Error updateRefreshToken()');
        }
        return true;
    }

    /**
     * 토큰 유효성 체크
     * 
     * @param string $token 베어럴토큰
     * 
     * @return bool true
     */
    public function chkToken(string|null $token) {
        Log::debug('*****************chkToken start*****************');
        // 토큰 존재 유무 체크
        if(empty($token)) {
            throw new MyAuthException('E20');
        }

        // 토큰 위조 검사
        list($header, $payload, $signature) = $this->explodeToken($token);
        if(MyEncrypt::subSalt($this->createSignature($header, $payload), env('TOKEN_SALT_LENGTH'))
         !== MyEncrypt::subSalt($signature, env('TOKEN_SALT_LENGTH'))) {
            throw new MyAuthException('E22');
        }

        // 유효시간 체크
        // 현재시간보다 작으면 과거시간
        if($this->getValueInPayload($token, 'exp') < time()) {   // exp : 유효시간
            throw new MyAuthException('E21');
        }

        Log::debug('*****************chkToken end*****************');
        return true;
    }

     /**
      * 페이로드에서 해당하는 키의 값을 반환
      * 
      * @param string $token
      * @param string $key
      * 
      * @return 페이로드에서 추출한 값
      */
      public function getValueInPayload(string $token, string $key) {
        // 토큰 분리
        list($header, $payload, $signature) = $this->explodeToken($token);
        $decodedPayload = json_decode(MyEncrypt::base64UrlDecode($payload));

        // 페이로드에 해당 키의 데이터가 있는지 체크
        if(empty($decodedPayload) || !isset($decodedPayload->$key)) {
            throw new MyAuthException('E24');
        }

        return $decodedPayload->$key;


      }

    // ----------------------------------- 
    // private
    // ----------------------------------- 
    
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

     /**
      * 토큰 분리
       *
       * @param string $token
       * 
       * @return array $header, $payload, $signature
      */
     private function explodeToken($token) {
        $arrToken = explode('.', $token);

        // 토큰 분리 오류 체크
        if(count($arrToken) !== 3) {
            throw new MyAuthException('E23');
        }

        return $arrToken;
     }

}