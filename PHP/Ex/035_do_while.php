<?php

// do_while : 무조건 한번은 실행하고 조건은 체크하는 반복문(while문을 쓰지 do_while문은 거의 쓰지 않는다.)

$cnt = 1;

while($cnt < 1) {
    echo "와일문";
}

do {
    echo "두 와일문";
    break;            // 실행하고 싶은 소스코드는 중괄호 안에 적자
} while($cnt < 2);
