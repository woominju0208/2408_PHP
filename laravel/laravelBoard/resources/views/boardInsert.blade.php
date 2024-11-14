@extends('layout.layout')

@section('title', '작성 페이지')

@section('bodyClassVh', 'vh-100')

@section('main')

<!-- main -->
<main class="d-flex justify-content-center align-items-center h-75">
<!-- enctype="multipart/form-data" : form에 보낼값이 file이라는걸 명시 -->
  <form style="width: 300px;" action="{{ route('post.boards') }}" method="POST" enctype="multipart/form-data">  
    @csrf  
    <!-- 에러 메시지 -->
      @if ($errors->any())
        <div id="errorMsg" class="form-text text-danger">
          @foreach ($errors->all() as $errorMsg)
              <span>{{ $errorMsg }}</span>
              <br>
          @endforeach
        </div>
          
      @endif
      <!-- 이메일 작성 -->
      <div class="mb-3">
        <label for="b_title" class="form-label">제목</label>
        <input type="text" class="form-control" id="b_title" name="b_title">
      </div>
      <!-- 비밀번호 작성 -->
      <div class="mb-3">
        <label for="b_content" class="form-label">내용</label>
        <input type="text" class="form-control" id="b_content" name="b_content">
      </div>
      <div class="mb-3">
        <label for="file" class="form-label">이미지</label>
        <input type="file" name="file">
      </div>
      <button type="submit" class="btn btn-dark w-100 mb-3">작성</button>
      <a href="{{ route('boards.index') }}" class="btn btn-secondary w-100">취소</a>
      <!-- input hidden으로 value값에 게시판 보드타입 넘겨주기 -->
      
    </form>
</main>
@endsection