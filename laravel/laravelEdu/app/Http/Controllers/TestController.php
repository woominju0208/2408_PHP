<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // Route, controller, view를 한번에 연결함
    public function index() {
        // return '테스트인덱스';
        $result = '홍길동';

        return view('test')
                    ->with('name', $result);    // ->with('변수이름', $들어올 값); => view에 값을 출력할수있음  <p>{{ $name }}</p>
    }
}

// Route : view를 유저에게 보여주기 위한 통로
// Controller : 유저가 요청한걸 view와 연결하여 연결
// View : 유저가 요청한 페이지 부분(html)