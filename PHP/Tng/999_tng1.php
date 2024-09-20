<?php
// 구구단
// **** 2단 ****
// 2 X 1 = 2
//  ...

// for문으로 **** 2단 **** 부터 출력 다음 for문으로 구구단 출력
// for($i = 2; $i <= 9; $i++) {
//     echo " **** ".$i."단 **** "."\n";
//     for($z = 1; $z <=9; $z++) {
//         echo $i. " X ". $z. " = ". ($i*$z)."\n";   
//     }
// }

// echo "\n";

// for($i = 1; $i <= 5; $i++) {
//     for($z = 1; $z <= $i; $z++) {
//         echo "*";
//     }
//         echo "\n";
// }

// echo "\n";

// for($i = 5; $i >= 1; $i-- ) {
//     for($z = 1; $z <= $i; $z++) {
//         echo "*";
//     }
//         echo "\n";
// }


// 삼각형 만들기(앞에 공백)
// 가위바위보 만들기
// 로또랜덤번호 뽑기(중복x)

echo "\n";

// ---------------------------------------------------
// function
// 특정 코드를 모듈화해서 여러군데에 사용가능 (유지보수가 쉬워짐, 코드 중복 제거)
// 왜 사용해야 하는지 알아야한다.
// 두수를 더해서 반환하는 함수

// function my_plus(int $num1, int $num2): int {   // my_plus() 에 ()안에 값이 parameter
//                 //int 가 타입힌트        // : int 는 return 값이 int타입힌트
//     return  $num1 + $num2;         // 반환
// }

// echo my_plus(1, 2);
// // ()안에 값이 argument

// echo "\n";

// function my_plus1(int $num1, int $num2 = 10): int {   // my_plus() 에 ()안에 값이 parameter
//     //int 가 타입힌트 
// return  $num1 + $num2;         // 반환
// }

// echo my_plus1(1);
// // $num2의 default 로 10을 설정해 $num1만 넣었을때 1과 10이 출력된다.

// echo "\n";


// function my_plus2($str1, $str2): string {   // my_plus() 에 ()안에 값이 parameter
//     // string 가 타입힌트 
//     return  $str1 . $str2;         // 반환
// }

// echo my_plus2("a", "b");



// ---------------------------------------------------
// 예외처리
// try{
//     // 처리하고자 하는 로직
//     5 / 0;
// }catch(Throwable $th) {    // $th 가 Throwable의 데이터타입을 담음
//     echo $th->getMessage();
//     // 예외발생시 할 처리
// } finally {
//     // 예외의 발생여부와 상관없이 항상 실행 할 처리
//     echo "finally\n";
// }

// echo "처리끝";
// // catch(Throwable $th) {
// //     // throwable은 php 7버젼 이후부터 가능
// //     // throwable 대신 exception 사용

// try{
//     echo "바깥쪽 try\n";     // try에 예외처리가 있어도 echo문이 더 위에 있기 때문에 먼저 출력
//     5 / 0;

//     try{
//         5 / 0;
//         echo "안쪽 try\n";
//     }catch(Throwable $th) {
//         echo "안쪽 catch\n";
//     }
// }catch(Throwable $th) {

//     echo "바깥쪽 catch\n";

// }
// // 바깥쪽 try, 바깥쪽 catch

// // 예외를 감싸고 있는 예외문만 예외처리
// // 바깥쪽 try문에서 예외처리가 해당되면 그이후에 있는 안쪽에 있는 try문은 아예 처리하지 않는다.
// // catch문에는 예외가 발생할 처리를 넣지않는게 좋다.
// // catch문엔 오류메세지정도만 입력 해 놔야한다.


// ---------------------------------------------------
// 강제 예외 발생
// try{
//     throw new Exception("강제 예외 발생");  // 여기서 강제 예외 발생 그이후에 처리 x
//     echo "try";
// }catch(Throwable $th) {
//     echo $th->getMessage();
// }

// ---------------------------------------------------
// 캐스팅(일회성 $num의 데이터타입이 string으로 바뀐건 아님)
// 형변환
$num = 1;
var_dump((string)$num);

