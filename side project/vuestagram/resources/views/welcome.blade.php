<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- vue프로젝트는 이제 app.js로 불러오기 때문에 resources안에 vue파일을 갖고오기 위해 asset으로 스크립트를 가져오는것 --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>VueStagram</title>
</head>
<body>
    <div id="app">
        {{-- 컴포넌트 파일이름에 맞게 단어사이에 - 을 넣고 만듬 --}}
        {{-- welcome.blade에는 가장 최상위 app컴포넌트만 넣고 끝 --}}
        <App-Component></App-Component>
    </div>
</body>
</html>