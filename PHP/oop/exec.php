<?php

require_once('./Whale.php');
require_once('./FlyingSquirrel.php');
require_once('./GoldFish.php');

use PHP\oop\Whale;
use PHP\oop\FlyingSquirrel;
use PHP\oop\GoldFish;

// 기존(Whale)에 생성자가 없으면 부모(Mammal)의 있던 생성자를 사용
// printInfo 도 부모에 상속을 받아 쓸수있음
$whale = new Whale('고래', '바다');
echo $whale->printInfo();
// $whale->name = $name;
// $whale->residence = $residence;

$flyingSquirrel = new FlyingSquirrel('날다람쥐', '산');
echo $flyingSquirrel->printInfo();

$goldFish = new GoldFish();
echo $goldFish->printPet();
