<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ---------------------------
// 라우트 정의
// ---------------------------
// 라우트는 특정처리를 이어주는 관문 역할
// 클로져 는 콜백함수랑 비슷 PHP에서 클로져 = 익명함수 = 콜백 라는 의미
// namespace, use, 조건 이런거 다 적을필요없음 
// return 처리만 하면 내장 서버에 주소에 적기만 하면 출력이 바로 가능 : 라라벨 라이브러리가 모든걸 처리
// 인스턴스화 없이 사용가능 ()
Route::get('/hi', function() {
    return '안녕하세요.';
});

Route::get('/hello', function() {
    return 'hello';
});

Route::get('/myview', function() {
    return view('myView');
});

// ----------------------------------
// httpMethod에 대응하는 라우터
// ----------------------------------
Route::get('/home', function() {
    return view('home');
});

Route::post('/home', function() {
    return 'HOME POST';
});

Route::put('/home', function() {
    return 'HOME PUT';
});

Route::delete('/home', function() {
    return 'HOME DELETE';
});

Route::patch('/home', function() {
    return 'HOME PATCH';
});


// ----------------------------------
// 파라미터 제어
// ----------------------------------
// Request Illuminate\HTTP\Request 사용으로 url에 parameter 를 제어할수 있다.
Route::get('/param', function(Request $request) {
    // ->id,->name은 request객체의 프로퍼티
    // $request안에 Request라는 객체가 담겨있음
    return 'ID : '.$request->id.' NAME : '.$request->name;
});
// url : http://127.0.0.1:8000/param?id=1&name=aa


// 세그먼트 파라미터(Restful API랑 관련)
// 세그먼트 파라미터도 여러개 넣을수 있음
// 단순히 값 하나만 보낼거면 세그먼트 파라미터로 보낸다. => http://localhost:8000/board/1 
// http://localhost:8000/param/1
// '/{id}' 값과 ($id)의 값이 같아야함  
Route::get('/param/{id}/{name}', function($id, $name) {
    return $id.' : '.$name;
});

// 세그먼트 파라미터도 (Request $request)형태로 적을수 있다. 앞뒤에 갯수를 안맞춰도 됌
Route::get('/param/{id}', function(Request $request) {
    return $request->id;
});
// :get('/param/{id}' 안에 {id} {} 안에 적힌 id를 $request안에 담는다.

// 이런식으로 $request->id , $id 섞어서 쓸수도 있다.
Route::get('/param2/{id}', function(Request $request, $id) {
    return $request->id."  ".$id;       // URL 에 param2/2를 치면 2 2로 출력($request->id와 $id가 세그먼트 파라미터로 출력되기 때문)
});

// 세그먼트 파라미터의 디폴트 설정
// url 에 path가 겹치지 않도록 조심해야한다.

// 아래랑 url이 같아져서 같은 url이면 먼저 위에 적힌게 출력된다. 그래서 '0'이 아닌 '파람3' 출력 url 겹치지 않게 조심!!
// Route::get('/param3', function() {
//     return '파람3';
// });
// 이건 디폴트 값을 0 으로 주고 path에 아무것도 입력안하고 디폴트인 0 이뜸
// 디폴트설정엔 {id?} 같이 '?' 넣어줌
// 세그먼트에 데이터 타입을 지정해 줄수도 있다. 문자넣으면 오류
Route::get('/param3/{id?}', function(int $id = 0) {
    return $id;
});


// ----------------------------------
// 라우트명 지정
// ----------------------------------
// view불러올시 return view('view파일이름');
Route::get('/name', function() {
    return view('name');    // 리턴후 html전체를 넣어도 출력된다.(html은 문자열이기 때문 하지만 유지보수 최악)
});

// Route에 네임을 long으로 지정하면 /home/na/hon/php 패스 다 적을필요 없이 view파일에 Route네임을 적어주면 된다.(유지보수 좋아용👍)
Route::get('/home/na/hon/php', function() {
    return '좀 긴 패스';
})->name('long');


// ----------------------------------
// 뷰에 데이터를 전달
// with라는 체이닝메소드 추가
// ----------------------------------
Route::get('/send', function() {
    $result = [
        ['id' => 1, 'name' => '홍길동']
        ,['id' => 2, 'name' => '갑순이']
    ];

    // return view('send')
    //         ->with('gender', '무성')
    //         ->with('data', $result);

    // 위에 with를 한번에 쓰는법은 with안에 []배열을 넣어서 사용
    return view('send')
                ->with([
                    'gender' => '무성'
                    ,'data' => $result
                ]);
});


// ----------------------------------
// 대체 라우트
// 에러페이지 작성후 view로 파일을 불러오면 된다!
// ----------------------------------
// 우리가 지정한 라우트외의 모든 라우트를 자정하는 라우트
Route::fallback(function() {
    return '이상한 URL 입니다.';
});


// ----------------------------------
// 라우트 그룹
// 같은 주소인 라우트들을 한번에 적어준다. (공통된 접두사)
// 공통된 미들웨어 사용할때 사용
// ----------------------------------
// Route::get('/users', function() {
//     return 'GET : /users';
// });
// Route::post('/users', function() {
//     return 'POST : /users';
// });
// Route::put('/users/{id}', function() {
//     return 'PUT : /users';
// });
// Route::delete('/users/{id}', function() {
//     return 'DELETE : /users';
// });

Route::prefix('/users')->group(function() {
    Route::get('', function() {
        return 'GET : /users';
    });
    Route::post('', function() {
        return 'POST : /users';
    });
    Route::put('/{id}', function() {
        return 'PUT : /users';
    });
    Route::delete('/{id}', function() {
        return 'DELETE : /users';
    });
});
