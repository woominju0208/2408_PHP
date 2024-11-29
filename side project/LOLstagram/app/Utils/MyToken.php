<?php

namespace App\Utils;

use MyEncrypt;
use App\Models\User;
use App\Utils\MyEncrypt as UtilsMyEncrypt;

class MyToken {
    public function createTokens(User $user) {
        $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));
        $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'));

        return [$accessToken, $refreshToken];
    }

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

}