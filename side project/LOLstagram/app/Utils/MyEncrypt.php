<?php

namespace App\Utils;
use Illuminate\Support\Str;

class MyEncrypt {
    // base64 URL 인코드
    // base64Url 형식으로 +/를 -_로 바꾸고 오른쪽에 있는 = 을 없앤다.
    public function base64UrlEncode(string $json) {
        return rtrim(strtr(base64_encode($json), '+/', '-_'), '=');
    }

    // 솔트(특정 길이 만큼 랜덤한 문자열) 생성
    public function makeSalt($saltLength) {
        return Str::random($saltLength);
    }

    // 문자열 암호화
    public function hashWithSalt(string $alg, string $str, string $salt) {
        return hash($alg, $str).$salt;
    }
}