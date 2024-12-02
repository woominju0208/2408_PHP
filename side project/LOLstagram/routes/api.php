<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
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

// Route::post('/login', function() {
//     return '로그인 성공';
// });
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('my.auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/reissue', [AuthController::class, 'reissue'])->name('auth.reissue');

    // 게시판 관련
    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');

});

