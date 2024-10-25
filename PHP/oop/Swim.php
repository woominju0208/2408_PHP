<?php
namespace PHP\opp;

// 인터페이스는 추상메소드만 넣을수 있다.
// 인터페이스는 금붕어를 만드는 설계도? 같은것 
// 중복상속은 안되지만 중복인터페이스 가능
// Swim을 인터페이스를 두면 Goldfish에 필수로 넣어줘야 함 
// abstract를 안적어도 된다.
interface Swim {
    public function swimming();
}