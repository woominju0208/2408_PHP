<?php
namespace PHP\oop;

require_once('./Mammal.php');
require_once('./Pet.php');


use PHP\oop\Mammal;
use PHP\oop\Pet;

// 상속받을 부모를 extends 함수이름을 적어줌(required도 같이!)
class FlyingSquirrel extends Mammal implements Pet {

    // 비행 메소드
    public function flying() {
        return '날아갑니다.';
    }

    // 오버라이딩
    // 부모쪽에 있던 요소를 자식쪽에서 재정의
    public function printInfo(){
        return ' 날다람쥐다람쥐';
        // return parent::printInfo()."\n".'룰루랄라';
    }

    public function printPet() {
        return '펫입니다 찍찍';
    }
}