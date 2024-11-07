<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
</head>
<body>
    <h1>HOME</h1>
    {{-- HTTP METHOD --}}
    {{-- GET : 해당 데이터 조회 --}}
    {{-- POST : 해당 데이터 삽입 --}}
    {{-- PUT : 기존에 있는 데이터 전부 수정, 해당 데이터 없으면 새롭게 생성 --}}
    {{-- DELETE : 기존에 있는 데이터 삭제 --}}
    {{-- PATCH : 기존에 잇는 데이터 부분 수정 --}}

    <form action="/home" method="post">
        {{-- 라라벨 CSRF 토큰 처리방식 @csrf 필수 --}}
        @csrf   
        <button type="submit">POST</button>
    </form>
    <hr>
    <form action="/home" method="post">
        {{-- @method 가 input hidden 형태로 전환 --}}
        {{-- form method는get, post만 있어서 나머지 요청 메소드는 폼태그에 메소드를 post로 해주면 됨 --}}
        @csrf
        @method('PUT')
        <button type="submit">PUT</button>
    </form>
    <hr>
    <form action="/home" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>
    <hr>
    <form action="/home" method="post">
        @csrf
        @method('PATCH')
        <button type="submit">PATCH</button>
    </form>
</body>
</html>