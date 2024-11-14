<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
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

// url에 따로 적지 않아도 goLogin /login으로 이동
// redirect : 사용자가 처음 요청한 URL이 아닌 다른 URL로 보내는 것을 의미
Route::get('/', function () {
    return redirect()->route('goLogin');
});

// 로그인페이지 /login 이동
Route::get('/login', [UserController::class, 'goLogin'])->name('goLogin');
// 로그인 관련
Route::post('/login', [UserController::class, 'login'])->name('login');
// 로그아웃
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// 게시판관련 (이동)
// ->except([]) : update, edit action method 제외
Route::middleware('auth')->resource('/boards', BoardController::class)->except(['update', 'edit']);

// 미들웨어는 제일앞에나 제일 뒤에 작성
// 미들웨어로 Authenticate를 사용했는데 middleware('auth')인 이유는 app/Kernel.php 파일에 이미 라라벨에서 그 파일이름을 'auth'로 명칭해서 사용가능

// 회원가입 이동
// Route::get('/regist', [UserController::class, 'regist'])->name('regist');
// Route::post('/regist', [UserController::class, 'makeAccount'])->name('makeAccount');

Route::get('/registration', [UserController::class, 'registration'])->name('get.registration');
Route::post('/registration', [UserController::class, 'storeRegistration'])->name('post.registration');


// 작성페이지 이동
Route::get('/boardInsert', [BoardController::class, 'create'])->name('get.boards');
Route::post('/boardInsert', [BoardController::class, 'store'])->name('post.boards');


