<?php
namespace PHP\oop;
require_once('./Mammal.php');
require_once('./Swim.php');


// Mammal의 namespace를 가져오겠다.
use PHP\oop\Mammal;
use PHP\opp\Swim;

// 상속받을 부모를 extends 함수이름을 적어줌(required도 같이!)
class Whale extends Mammal implements Swim {

    // 수영 메소드
    public function swimming() {
        return '수영합니다.';
    }
    public function printInfo() {
        return '고래고래고래';
    }
}


































// ---------------------------------------------------------------------------------

// 프로퍼티 : 필드 {}내네 정의된 변수
// 메소드   : 클래스(필드) 내부에 정의된 함수

// 첫번째글자는 대문자,뒤는 카멜기법,파일이름과 클래스이름이 같아야 함

// class Whale {
//      // 프로퍼티
//     public $name;
//     // public시 외부에서 접근가능(그럴 상황에만 사용)
//     private $age;

//     // 생성자 메소드(Construct)
//     // 무조건 이 형태로 만들기
//     // 무조건 최초 1회 실행 됨
//     // 안적어도 디폴트로 생성자 기본값이 적혀서 안적어도 오류가 안남
//     public function __construct($name, $age){
//         $this->name = $name;
//         $this->age = $age;

//     }

//     // 메소드
//     public function breath() {
//         return '숨을 쉽니다.';
//     }
//     // 외부에서 사용하기 위해 public로 작성 
//     public function printInfo() {
//         return $this->name."는 ".$this->age.'살 입니다.';
//     }

//     // getter(받고) / setter(변경) 메소드
//     public function getAge() {
//         return $this->age;
//     }
//     public function setAge($age) {
//         $this->age = $age;
//     }

//     // static method
//     // 인스턴스화를 사용하지 않고도 사용가능
//     // 전부 다 스태틱을 하면 용량을 많이 잡아먹고 프로젝트가 느려지기 때문에 전부 스태틱화 해선 안된다. 자주 쓰는 꼭 필요한 것만 스태틱화 
//     public static function dance() {
//         return '고래가 춤을 춥니다.';
//     }
// }

// echo Whale::dance();

// // private가 말하는 내부는 class Whale { } 이 {}안을 말하는 것이다. {}안을 나가면 사용할수 없음
// // 같은 위치에 있는 건 $this를 사용해 가져온다.

// // // Whale Instance
// // // 변수를 만들어서 Whale의 칸을 만들어둔것
// // $whale = new Whale();
// // $whale2 = new Whale();
// // // echo $Whale->printInfo();

// // echo $whale->getAge();    // class Whale age = 20; 출력
// // $whale->setAge(30);      // class Whale age = 30; 선언
// // echo $whale->getAge();  // class Whale age = 30; 출력

// // // whale 에 30을 set했으니 whale2엔 적용 xx
// // echo $whale2->getAge();  

// // $whale = new Whale('핑크고래', 40);
// // echo $whale->printInfo();