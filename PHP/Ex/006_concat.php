<?php

// 연결 연산자
// .을 이용해 변수와 변수를 이어준다(문자열도 가능)
$str1 = " 안녕, ";
$str2 = " PHP!!";

$concat1 = $str1.$str2."\n";

echo $concat1;

$str3 = "\"안녕";
$str4 = "하세요\"";
$num = 1234;

$concat2 = $str3.$str4."~".$num;
echo $concat2;

// 숫자열을 연결연산자로 이으면 숫자열이 문자열로 바뀐다
// \는 익스케이프 문자로  "를 쓰고 싶으면 \"을 적어주면 가능