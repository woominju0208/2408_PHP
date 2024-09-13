<?php
// directory = file

// ------------------
// 디렉토리(폴더) 생성
// ------------------
// $mkdir_result = mkdir("./my_dir");    // 같은 위치에 파일생성

// if($mkdir_result) {
//     // 정상일경우 처리 (디렉토리 생성 코드)
// } else{
//     // 실패일 경우 처리 (실패했다 출력)
// }

// // 바로 파일을 생성하는데 정상일 경우 처리 > 실패시 파일생성 실패
// if(mkdir("./my_dir")) {
//     // 정상일경우 처리
// } else {
//     // 실패일 경우 처리
// }

// ------------------
// 디렉토리 존재 유무 체크
// ------------------
// $chk_result = is_dir("./my_dir");
// if($chk_result) {
//     echo "있다";
// }else {
//     echo "없다";
// }
// 디렉토리 존재 체크후 있으면 바로 파일생성 없으면 디렉토리 생성후 파일 생성

// ------------------
// 디렉토리 열기 및 읽기
// ------------------
// $open_result = opendir("./my_dir"); // 디렉토리 열기

// while($file = readdir($open_result)) {
//     echo $file."\n";
// }

// readdir은 하나하나 파일을 읽어서 여러번 실행을 위해 반복해야하기 때문에 while 을 쓴다.
// while반복으로 파일을 하나하나 읽다가 파일을 전부 읽으면 false가 된다.

// . 내위치
// .. 전 파일로 돌아간다. 그래서 파일을 읽을때 무조건 . .. 파일명이 나오는것

// ------------------
// 디렉토리 닫기(필수)
// ------------------
// closedir($open_result);
// 오픈했으면 닫아주는거 까지 잊지말고 해주자

// ------------------
// 디렉토리 삭제 (안에 다른 파일이 있을시 삭제를 못함)
// ------------------
// rmdir("./my_dir");

// ----------------------------------------------------------------------------------------------
// ------------------------------------
// 파일 열기
// 있으면 해당파일을 열고 없으면 파일까지 생성하고 열어준다 text.txt파일이 없었는데 알아서 생성 해 주었다.
$file = fopen("./my_dir/test.txt", "a");
if($file) {
    // 파일열기 성공시 처리
    // --------------------
    // 파일에 쓰기
    // --------------------
    fwrite($file, "떡볶이");  // 파일에 쓰기
}else {
    // 파일열기 실패시 처리
    echo "파일 열기 실패";
}

// --------------
// 파일 닫기
// --------------
fclose($file);

// --------------
// 파일 삭제 (폴더안에/파일이름)
// --------------
unlink("./my_dir/test.txt");

// 라라벨같은 프레임워크 사용시에는 함수값만 하나 가져오면 파일을 만들고 불러오고 알아서 설정해준다.
// 순수php 로 입력시에는 필요한 작업이다.(백엔드 처음 설정시에 사용)