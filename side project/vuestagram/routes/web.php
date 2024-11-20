<?php

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

// {any}: 어떠한 패스(url)로 실행해도 이 패스가 실행
// 뷰한테 화면전환을 전부 요청한단 의미 > welcome.blade.php > appComponent.vue
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
