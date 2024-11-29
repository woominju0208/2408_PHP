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

// Route::post('/login', function() {
//     return '로그인 성공';
// });
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Route::get('/boards', [AuthController::class, 'boards'])->name('boards.index');
