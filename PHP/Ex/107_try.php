<?php


try {
    echo "try문 시작";
    // 예외나 에러가 발생할 가능성이 있는 소스코드를 작성(어느 값이 올지는 알수 없다. 에러가 날거같은 데이터를 넣어서 에러발생 예외처리)
    5 / 0;

    echo "try문 끝";
} catch(Throwable $th) {
    // try문에서 예외나 에러가 발생했을 때 실행할 소스코드를 작성
    echo "catch 예외발생";
} finally {
    // finally는 무조건 처리된다. 예외가 발생하든 발생하지 않든 무조건 처리해줘야 한다.
    echo "finally";
    
}
// 밖에 finally문을 넣으면 만약 try{} 안에 에러창이 뜬다면 다른곳으로 이동하기 때문에 try밖에 있는 finally처리가 적용되지 않는다. 그래서 같이 try안에 넣어줘야함
