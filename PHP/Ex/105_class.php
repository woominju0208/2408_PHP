<?php

// 클래스 파일 require로 불러오기 필수
require_once("./Whale.php");

// breath(); :스코프가 다르기 때문에 class안에 function을 가져오지 못함

// // 인스턴스화(객체화)
// // 인스턴스화는 클래스파일안에 넣는게 아니라 사용하고 싶은 파일에 인스턴스화 코드를 꼭 적어줘야한다.
$whale = new Whale();

// Class의 메소드 사용방법
$whale->breath();

// 프로퍼티 접근
echo $whale->name; // public 이므로 외부로 접근 가능 
// echo $whale->age;  // private이므로 접근이 불가

echo "\n";


// echo $whale->info();

echo $whale->info();


// this -> breath()를 적었을때   function breath() {
                            // echo "숨을 쉽니다.";
                            // } 로 인해 this나이는 보다 앞에 함수 숨을쉽니다.출력 다음에 this나이는 이 출력

// 함수는 따로 인스턴스화를 안해도 객체화 되는거고 클래스는 따로 인스턴스화 객체 표시를 해줘야한다?

// 스태틱 멤버에 접근
Whale::myStatic();


require_once("./Shark.php");
// 상어 클래스
$shark = new Shark("상어");
echo $shark->name;

// 클래스require_once로 가져오기 > 클래스를 인스턴스화  /까지가 필수/ > 프로퍼티(클래스안 변수) 접근/ 메소드(클래스안 함수) 접근 > 스태틱 멤버 접근 