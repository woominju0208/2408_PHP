<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- section을 불러오지못하면 , 뒤에 기본 출력값으로 설정된다.  --}}
    <title>@yield('title', '레이아웃')</title>
</head>
<body>
    @include('layout.header')
    
    @yield('main')

    {{-- @section ~ @show : 자식 템플릿에 해당하는 section이 없으면 부모코드 실행 --}}
    @section('show')
    <h2>부모 show 입니다.</h2>
    <h3>많은 처리</h3>
    @show

    @include('layout.footer')
</body>
</html>