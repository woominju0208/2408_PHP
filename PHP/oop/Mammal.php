<?php
// namespace는 보통 파일위치로 해준다.
// 클래스를 만들때 namespace 필수
// 상속받는 자식들은 use 필수
// namespace는 최상단에 해줘야 한다.
namespace PHP\oop;

// 추상 클래스
// 추상클래스안에는 추상메소드, 일반메소드 둘다 있을수 있다.
// 자식에게 확장시키는 용도로 사용
abstract class Mammal {
    private $name;
    private $residence;

    public function __construct($name, $residence){
        $this->name = $name;
        $this->residence = $residence;
    }

    // 추상 메소드
    abstract public function printInfo();
}




// class Mammal {
//     private $name;
//     private $residence;

//     // 생성자
//     public function __construct($name, $residence){
//         $this->name = $name;
//         $this->residence = $residence;
//     }

//     // 정보 출력
//     public function printInfo() {
//         return $this->name.'가 '.$this->residence.'에 삽니다.';
//     }
// }
// // final public function printInfo() {
// // 오버라이딩을 막기위해서는 앞에 final을 적어주면 방지할수 있다.