<?php
// new 클래스의 새로운 객체가 인스턴스화가 되기 직전에 자동으로 실행되고
// $path 파라미터에 Route\Route 가 담김
// \ 역슬래시하나는 빈문자열로 인식 \\로 적어줘야 \가 찍힘
spl_autoload_register(function($path) {
    // str_replace('바뀔부분', '바꿀문자', '바꿀부분')
    require_once(str_replace('\\', '/', $path).'.php');
    

});     // Route/Route.php
