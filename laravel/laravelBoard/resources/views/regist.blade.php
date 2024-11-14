@extends('layout.layout')

@section('title', '회원가입 페이지')

@section('bodyClassVh', 'vh-100')

@section('main')
<!-- main -->
<main class="d-flex justify-content-center align-items-center h-75">
    <form style="width: 300px;" action="{{ route('regist') }}" method="POST">
      @csrf
      {{-- 에러메세지 출력 --}}
      @if ($errors->any())
        <div id="errorMsg" class="form-text text-danger">
          @foreach ($errors->all() as $errorMsg)
              <span>{{ $errorMsg }}</span>
              <br>
          @endforeach
        </div>
      @endif
        <div class="mb-3">
          <label for="u_email" class="form-label">아이디</label>
          <input type="email" class="form-control" id="u_email" name="u_email">
        </div>
        <div class="mb-3">
          <label for="u_password" class="form-label">비밀번호</label>
          <input type="password" class="form-control" id="u_password" name="u_password">
        </div>
        <div class="mb-3">
          <label for="chk_password" class="form-label">비밀번호 확인</label>
          <input type="password" class="form-control" id="chk_password" name="chk_password">
        </div>
        <div class="mb-3">
            <label for="u_name" class="form-label">이름</label>
            <input type="text" class="form-control" id="u_name" name="u_name">
          </div>
        <button type="submit" class="btn btn-dark w-100 mb-3">가입 완료</button>
        {{-- 이동하는 a태그는 route('이름')으로 줘야 관리하기 쉬워진다. --}}
        <a href="{{ route('goLogin') }}" class="btn btn-secondary w-100">취소</a>
      </form>
</main>
@endsection


