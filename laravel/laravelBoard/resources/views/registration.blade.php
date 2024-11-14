@extends('layout.layout')

@section('title', '회원가입 페이지')

@section('bodyClassVh', 'vh-100')
    
@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
    <form style="width: 300px;" action="{{ route('post.registration') }}" method="POST">
        @csrf
        {{-- 에러메세지 출력 --}}
        {{-- 라라벨은 $errors라는 변수에 모든 에러메세지가 자동으로 담긴다. --}}
        {{-- $errors->any() : 에러메세지가 담겨있는지 없는지 체크 에러가 있으면 true 없으면 false --}}
        @if($errors->any())
            <div id="errorMsg" class="form-text text-danger">
                {{-- $errors->all() 모든 에러메세지 가져옴 --}}
                @foreach ($errors->all() as $errorMsg)
                    <span>{{ $errorMsg }}</span>
                    <br>
                @endforeach
            </div>     
        @endif

        <div class="mb-3">
            <label for="u_email" class="form-label">아이디</label>
            <input type="email" class="form-control" id="u_email" name="u_email" value="{{ old('u_eamil') }}">
            {{-- old는 유저가 이메일적었을때 계속 남아있게 할려고 사용 --}}
        </div>
        <div class="mb-3">
            <label for="u_password" class="form-label">비밀번호</label>
            <input type="password" class="form-control" id="u_password" name="u_password">
        </div>
        <div class="mb-3">
            <label for="u_password_chk" class="form-label">비밀번호 확인</label>
            <input type="password" class="form-control" id="u_password_chk" name="u_password_chk">
        </div>
        <div class="mb-3">
            <label for="u_name" class="form-label">이름</label>
            <input type="text" class="form-control" id="u_name" name="u_name">
        </div>
        <button type="submit" class="btn btn-dark w-100 mb-3">회원가입</button>
        <a href="{{ route('goLogin') }}" class="btn btn-secondary w-100">취소</a>
    </form>
</main>
@endsection