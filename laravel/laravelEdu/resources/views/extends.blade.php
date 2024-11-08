{{-- 상속 --}}
{{-- 반복되는 불필요한 코드를 없애기 위해 부모껄 상속받아서 그대로 쓸수 있다. --}}
{{-- 상속받은 layout파일에 소스코드를 상속 받았다. --}}
@extends('layout.layout')

{{-- @section : 부모템플릿에 해당하는 yield에 삽입 --}}
{{-- @section 과 @yield는 세트로 사용   section을 적으면 yield에 붙게된다. --}}
@section('title', '자식자식')

{{-- 여러 태그들을 보낼때는 @section,  @endsection을 사용해서 그 사이에 적을 태그들을 넣어준다. --}}
{{-- 위에 @section('main', '<h2>자식의 메인 영역</h2>') 이런식으로 적으면 태그가 아닌 문자로 출력하게 된다. --}}
@section('main')
<main>
    <h2>자식의 메인 영역</h2>
</main>
@endsection

@section('show', '자식자식 show')


<hr>
{{-- @if : 조건문 --}}
@if($data[0]['gender'] === 'F')
    <span>여자</span>
@elseif($data[0]['gender'] === 'M')
    <span>남자</span>
@else
    <span>알수없음</span>
@endif
{{-- 따로 묶지 않아서 조건문이 먼저 실행되어서 제일 위에 출력 --}}
<hr>
 
{{-- 반복문 --}}
{{-- @for ~ @endfor : for 반복문 --}}
@for($i = 0; $i < 5; $i++)
    <span>{{ $i }}</span>
@endfor
<hr>
{{-- 구구단 --}}
{{-- @for($i = 2; $i <= 9; $i++)
    <h3>{{ $i.'단' }}</h3>
    @for($z = 1; $z <= 9; $z++)
        <span>{{ $i.' X '.$z .' = '.($i*$z) }}</span>
        <br>
    @endfor    
@endfor         --}}

{{-- @foreach ~ @endforeach : foreach 반복문 --}}
@foreach ($data as $item)
    <div>
        <span>{{ $item['name'] }}</span>
        <span>{{ $item['gender'] }}</span>
        <span>남은 루프 횟수 : {{ $loop->remaining }}</span>
    </div>  
@endforeach
    
{{-- 홀수엔 빨강 짝수엔 파랑 css넣기 :foreach에 if로 조건문 제시 --}}
@foreach ($data as $item)
    @if($loop->odd)
        <div style="color: red;">
            <span>{{ $item['name'] }}</span>
            <span>{{ $item['gender'] }}</span>
            {{-- <span>남은 루프 횟수 : {{ $loop->remaining }}</span> --}}
        </div> 
    @else
    <div style="color: blue;">
        <span>{{ $item['name'] }}</span>
        <span>{{ $item['gender'] }}</span>
    </div>
    @endif     
@endforeach

{{-- 삼향연산자로 for문없이 css 색깔넣기 --}}
@foreach ($data as $item)
    <div style="{{ $loop->odd ? 'color: blue;' : '' }}">
        <span>{{ $item['name'] }}</span>
        <span>{{ $item['gender'] }}</span>
    </div>
@endforeach

{{-- @forelse ~ @empty ~ @endforelse :
    루프를 할 데이터가 길이가 1이상이면 @forelse의 처리,
    배열의 길이가 0이면 @empty의 처리를 합니다.
--}}
@forelse($data as $item)
    <div>{{ $item['name'] }}</div>
@empty
    <span>데이터 없음</span>
@endforelse

{{-- 가져올 배열의 데이터가 없으면 @empty의 내용을 출력한다. --}}
@forelse($data2 as $item)
    <div>{{ $item['name'] }}</div>
@empty
    <span>데이터 없음</span>
@endforelse

