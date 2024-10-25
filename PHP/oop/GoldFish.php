<?php
namespace PHP\oop;

require_once('./Swim.php');
require_once('./Pet.php');

use PHP\opp\Swim;
use PHP\oop\Pet;

// 인터페이스는 다중상속처럼 여러개 사용가능 , 로 여러개
class GoldFish implements Swim, Pet {
    private $name = '금붕어';
    
    public function swimming() {
        return '수영합니다.';
    }

    public function printPet() {
        return '펫입니다. 첨벙첨벙';
    }
}

// extends : 상속
// implements : 구현