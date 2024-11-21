<?php

namespace App\Utils;

use Illuminate\Support\Str;

// MyEncrypt Facade로 생성
class MyEncrypt {
    /**
     * base64 URL 인코드
     * 
     * @param   string $json
     * @return  string base64 URL encode
     */

     public function base64UrlEncode(string $json) {
        // 문자열을 base64_encode로 인코드
        // '+/'는 포함되면 안되기 때문에 strtr으로 '-_'로 변환
        // strtr(base64_encode) 하면 마지막 '=='이 생기니 rtrim으로 오른쪽 '=' 제거
        return rtrim(strtr(base64_encode($json), '+/', '-_'), '=');
     }

     /**
      * 솔트(특정 길이 만큼 랜덤한 문자열) 생성
      * 
      * @param inst $saltLength
      *
      * @return string 랜덤 문자열
      */
      public function makeSalt($saltLength) {
         return Str::random($saltLength);
      }

      /**
       * 문자열 암호화
       * 
       * @param   string $alg 알고리즘명
       * @param   string $str 암호화 할 문자열
       * @param   string $salt 솔트
       * 
       * @return  string 암호화 된 문자열
       */
      public function hashWithSalt(string $alg, string $str, string $salt) {
         // 혹시모를 해킹후 복구화를 할수있기 대문에 $alg, $str을 hash 암호화 한 다음 뒤에 $salt를 첨가해준다.
         // salt의 길이는 꼭 기억
         return hash($alg, $str).$salt;
      }
}