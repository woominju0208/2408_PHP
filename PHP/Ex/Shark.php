<?php

class Shark {
        public $name;     // 프로퍼티 클래스안에 변수


        // 생성자 (Construct)
        // 객체를 인스턴스화 할 때. 딱 한번만 실행되는 메소드
        public function __construct($name) {     // 메소드 클래스안에 함수
            $this->name = $name;
        }
}
// public의 $name 과 construct의 $name 은 다르다.



