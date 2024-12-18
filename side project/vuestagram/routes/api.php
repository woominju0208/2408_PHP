<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 토큰 인증 방식은 api.php에 작성
// api.php가 백엔드 처리, web.php 가 출력하는 프론트엔드 처리를 한다. (완전 분리)

// app.php 파일은 /api가 자동으로 붙어서 /페이지이름만 붙여주면 된다.
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Route::middleware('my.auth')->post('/logout', [AuthController::class, 'logout'])->name('post.logout');

// 인증이 필요한 라우트 그룹(미들웨어를 여러군데 쓸때 사용)
Route::middleware('my.auth')->group(function() {
    // 인증 관련
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    // 토큰 재발급 (인증필요해서 미들웨어 안에 작성)
    Route::post('/reissue', [AuthController::class, 'reissue'])->name('auth.reissue');

    // 게시글 관련
    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
    // 게시글 상세 
    Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');
    // 게시글 작성
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
});