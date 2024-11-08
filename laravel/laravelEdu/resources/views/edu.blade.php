<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- ㄴㅁㅇㄴㅁ -->
    <h1>이거는 보입니다.</h1>
    {{-- html 주석과 다르게 블레이드 템플릿 주석은 개발자도구에서도 보이지 않는다. 버젼 관리하기 용이 --}}
    {{-- 주석으로 메모 할때는 html 주석 사용 , 밖으로 정보가 새 나가지 않을려면 블레이드 템플릿 주석 --}}
    {{-- <h1>이거는 안 보입니다.</h1> --}}

    <p>{{ $data['name'] }}</p>
    <p>{{ $data['content'] }}</p>
    
    {{-- 퓨어php 에서는  htmlspecialchars 를 통해 외부 공격인 글을 문자열로 인식하게 만들어서 XSS 공격을 막으면 된다. --}}
    {{-- 라라벨에 {{ $data['content'] }} 와 같음 --}}
    <p><?php echo htmlspecialchars($data['content']); ?></p>    
</body>
</html>