<?php
//  PHP 내장함수

// ----------------
// trim(문자열) : 문자열의 좌우 공백을 제거해서 반환(문자사이 띄어쓰기는 x)
$str = "    미어캣    ";
echo trim($str);
echo "\n";

// ----------------
// strtoupper(문자열), strtolower(문자열) : 문자열을 대/소문자로 변환해서 반환(초기에 만들어진 내장함수)(명명규칙 등 일관성이 부족한 예시)
$str2 = "ABcde";
echo strtoupper($str2);
echo strtolower($str2);
echo "\n";

// ----------------
// mb_strlen(문자열) :문자열의 길이를 반환, 멀티바이트 문자열에 대응 (사용은 mb_strlen을 써야함)
// strlen(문자열);   :문자열의 길이를 반환, 멀티바이트 문자열에 대응 못함, 1바이트 인식(영어,숫자) 하지만 한글같은 3바이트는 인식 (사용xx)
// 띄어쓰기도 1바이트로 인식

$str3 = "미어캣";
echo strlen($str3);    
echo mb_strlen($str3);
echo "\n";

// ----------------
// str_replace(문자열) : 특정 문자를 치환해서 반환  (문자 중간사이 제거 할수 있음, 원하는 부분만 삭제 가능)
// str_replace("치환 할 문자열", "치환 될 문자열", 대상 문자열 변수)
$str4 = "key: 2313fffdaaf11asda21431";
echo str_replace("key: ", "", $str4);
echo "\n";

$str4 = "key: 2313fffdaaf11asda21431";
echo str_replace("f", "m", $str4);
echo "\n";
// 이런식으로 f라는 문자를 찾아서 전부 m으로 바꿔버린다.

// ----------------
// mb_substr(대상문자열, 자를 개수, 출력할 개수) :
$str5 = "PHP입니다.";
echo mb_substr($str5, 3, 3)."\n" ;    // 좌측부터 잘린다.
echo mb_substr($str5, -3, 3) ;    // 우측부터 잘린다.(좌측과 다르게 우측부터 자르고 좌측으로 출력된다.)
echo "\n";

// ----------------
// mb_strpos(대상문자열, 검색할 문자열) : 검색할 문자열의 특정 위치를 반환
$str6 = "점심 뭐먹지?";
echo mb_strpos($str6, "뭐")."\n";
// 시작 숫자가 0부터 시작  뭐먹처럼 몇글자를 넣어도 처음 뭐로 인식이 된다.

// 뭐부터 3글자를 잘라오기
echo mb_substr($str6, mb_strpos($str6, "뭐"), 3);   //뭐먹지 출력

// mb_substr과 mb_strpos를 조합해서 쓰는 경우가 많다.
// 코드가 길어질수록 오타가 안나게 잘 확인 하자 (error나옴)

echo "\n";
// ----------------
// sprintf(포멧문자열, 대입문자열1, 대입문자열2...) : 포멧 문자열에 대입문자열들을 순서대로 대입해서 변환
$str_format = "당신의 점수는 %d점 입니다. <%s>";

echo sprintf($str_format, 90, "A");
// %u :숫자열 양수만
// %d :숫자열 양수,음수
// %f :실수(소수점)
// %.1f:실수(소수점) 첫째자리까지 출력     > 소수점 둘째자리 %.2f
// %s :문자열
echo "\n";

// ----------------
// isset(변수) : 변수가 설정되어 있는지 확인하여 true/false 반환  (출력은 var_dump로 true/false 반환)
$str7 = "";
$str8 = null;
var_dump(isset($str7));  //true
var_dump(isset($str8));  //false
var_dump(isset($no));    //false

echo "\n";
// ----------------
// empty(변수) : 변수의 값이 비어있는지 확인해서 true/false 반환
$empty1 = "abc";
$empty2 = "";
$empty3 = 0;
$empty4 = [];
$empty5 = null;
var_dump(empty($empty1));     //f
var_dump(empty($empty2));     //t  
var_dump(empty($empty3));     //t
var_dump(empty($empty4));     //t
var_dump(empty($empty5));     //t
// 값이 없는게 아니라 비어있음 으로 "", 0, []. null 은 비어있다라고 인식

echo "\n";
// ----------------
// is_null(변수) : 변수가 null인지 아닌지 확인하여 true/false를 반환(null 빼고 나머지는 전부 false)
$chk_null = null;
var_dump(is_null($chk_null));

echo "\n";
// ----------------
// gettype(변수) : 변수의 데이터 타입을 문자열로 반환 (데이터 타입작성 시 오류가 생길수 있어 gettype으로 데이터타입이 어떤지 확인)
$type1 = "abc";
$type2 = 0;
$type3 = 1.2;
$type4 = [];
$type5 = true;
$type6 = null;
$type7 = new DateTime();
echo gettype($type1)."\n";
echo gettype($type2)."\n";
echo gettype($type3)."\n";
echo gettype($type4)."\n";
echo gettype($type5)."\n";
echo gettype($type6)."\n";
echo gettype($type7)."\n";

// 타입 체크 예
if(gettype($type2) === "integer") {
    echo "숫자임\n";
}
if(gettype($type1) === "string") {
    echo "문자임\n";
}


echo "\n";
// ----------------
// settype(변수, 데이터타입) : 변수의 데이터 타입을 변환(데이터 타입 꼭 적어줘야 함)
$type8 = "1";
// var_dump((int)$type8);     // 원본은 변경하지 않고 캐스팅
settype($type8, "int");       // 원본의 데이터 타입을 변환
var_dump($type8);

echo "\n";
// ----------------
// time() : 현재 시간을 반환 (TIMESTAMP 초단위)
echo time();

echo "\n";
// ----------------
// date(시간포맷, TIMESTAMP값) : 시간 포맷형식으로 문자열을 반환
echo date("Y-m-d H:i:s", time());
// echo date("Y.m.d Hi:s", time()); 이런식으로 사이에 원하는 형식으로 변경 가능

echo "\n";
// ----------------
// ceil(변수), round(변수), floor(변수) : 각 올림,반올림,버림하여 반환
echo ceil(1.2)."\n";      // 2
echo round(1.5)."\n";     // 2
echo floor(1.9)."\n";     // 1

echo "\n";
// ----------------
// random_int(시작값, 끝값) : 시작값부터 끝값까지의 랜덤한 숫자를 반환
echo random_int(1, 1000000000000000000);


// 말고도 내장함수들은 정말정말 많다.
// php와 다른 언어(java 나 c# 등등)들의 내장함수 이름은 전부 다르다.
echo random_int(1, 45);















