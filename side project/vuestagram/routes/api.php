<?php

use App\Http\Controllers\AuthController;
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
Route::post('/login', [AuthController::class, 'login'])->name('post.login');