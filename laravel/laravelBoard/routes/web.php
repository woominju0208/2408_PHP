<?php

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