<?php
// -----------------------------
// 다른 파일의 소스코드를 사용하기위해 불러오는 방법
// -----------------------------

// include : 해당 파일을 불러온다. (중복 작성할 경우 여러번 불러온다.)

// include("./070_include2.php");

// include_once (현업에선 이걸씀)
// 해당 파일을 불러온다. (중복 작성해도 중복없이 한번만 소스코드를 가져옴)
// include 공통점 : 오류 발생 시 프로그램을 정지하지 않고 처리 진행

// include_once("./070_include2.php");
// include_once("./070_include2.php");

// require : 해당 파일을 불러온다. (중복 작성할 경우 여러번 불러온다.)
// require_once : 해당 파일을 불러온다. (중복 작성해도 중복없이 한번만 소스코드를 가져옴)
// require 공통점 : 오류 발생 시 프로그램을 정지

// 현업에선 require_once, include_once 을 쓴다. (그냥 require_once 쓰자)

require_once("./070_include2.php");
require_once("./070_include2.php");  // include2 의 함수 호출


echo "include 1111\n";
echo my_sum(1,2);
echo my_sum1(2,1);


// 보통 외부로 가져오는 파일은 함수로있는 파일이거나 html파일을 가져온다.
// 불러올려는 파일이 함수파일이면 그 파일은 함수만 써두는게 기본
// include나 require 는 최상단에 파일을 호출해오고 처리한다.(어느 언어든 같다.)





