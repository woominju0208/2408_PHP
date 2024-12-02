<?php

namespace App\Utils;

use App\Exceptions\MyAuthException;
use MyEncrypt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;

class MyToken {
    // -----------------------------
    // public
    // -----------------------------
    // 토큰 생성
    public function createTokens(User $user) {
        $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));
        $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'));

        return [$accessToken, $refreshToken];
    }

    // 리프래시 토큰 업데이트
    public function updateRefreshToken(User $userInfo, string|null $refreshToken) {
        // 유저모델에 리프래시 토큰 변경
        $userInfo->refresh_token = $refreshToken;

        if(!($userInfo->save())) {
            DB::rollBack();
            throw new PDOException('Error updateRefreshToken()');
        }
        return true;
    }

    public function chkToken(string|null $token) {
        Log::debug('-------- chk START --------');
        // 토큰유무체크
        if(empty($token)) {
            throw new MyAuthException('E20');
        }

        // 토큰위조검사
        list($header, $payload, $signature) = $this->explodeToken($token);
        if(MyEncrypt::subSalt($this->createSignature($header, $payload), env('TOKEN_SALT_LENGTH'))
             !== MyEncrypt::subSalt($signature,  env('TOKEN_SALT_LENGTH'))) {
            throw new MyAuthException('E22');
        }

        // 토큰 유효시간 체크
        if($this->getValueInPayload($token, 'exp') < time()) {
            throw new MyAuthException('E21');
        }

        Log::debug('-------- chk END --------');
        return true;
    }


    public function getValueInPayload(string $token, string $key) {
        // 토큰 분리
        list($header, $payload, $signature) = $this->explodeToken($token);
        $decodePayload = json_decode(MyEncrypt::base64UrlDecode($payload));

        // 페이로드에 해당 키의 데이터가 있는지 체크
        if(empty($decodePayload) || !isset($decodePayload->$key)) {
            throw new MyAuthException('E24');
        }

        return $decodePayload->$key;
    }

    // -----------------------------
    // private
    // -----------------------------

    // JWT 토큰 발행
    private function createToken(User $user, int $ttl, bool $accessFlg = true) {
        $header = $this->createHeader();
        $payload = $this->createPayload($user, $ttl, $accessFlg);
        $signature = $this->createSignature($header, $payload);

        return $header.'.'.$payload.'.'.$signature;
 }

    //  JWT Header 생성
    private function createHeader() {
        $header = [
            'alg' => env('TOKEN_ALG')
            ,'typ' => env('TOKEN_TYPE')
        ];
        return MyEncrypt::base64UrlEncode(json_encode($header));
    }

    //  JWT Payload 생성
    
    private function createPayload(User $user, int $ttl, bool $accessFlg = true) {
        $now = time();

        $payload = [
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

    //  JWT Signature 생성
    private function createSignature(string $header, string $payload) {
        return MyEncrypt::hashWithSalt(
            env('TOKEN_ALG')
            ,$header.env('TOKEN_SECRET_KEY').$payload
            ,MyEncrypt::makeSalt(env('TOKEN_SALT_LENGTH'))
        );
    }

    // 토큰분리
    // explodeToken 생성
    private function explodeToken($token) {
        // .을 기준으로 토큰 나눔(헤더,페이로드,시그니쳐)
        $arrToken = explode('.', $token);
        // 토큰의 갯수가 3이 아닐시 에러처리
        if(count($arrToken) !== 3) {
            throw new MyAuthException('E23');
        }
        return $arrToken;
    }


}