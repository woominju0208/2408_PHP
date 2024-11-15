<?php

namespace App\Providers;

use App\Models\BoardsCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MyViewProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $view : 뷰가 랜더링할때 실행하니 랜더링한 정보를 담고있는 객체
        View::composer(['boardList', 'boardInsert'], function($view) {   // '*' 모든 뷰에서 실행
            // 특정 페이지를 하고 싶을때 '*' 대신 배열로 블레이드템플릿 이름을 적어주면 된다.
            $resultBoardCategoryInfo = BoardsCategory::orderBy('bc_type')->get();
            Log::debug('tt',$resultBoardCategoryInfo->toArray());
            $view->with('myGlobalBoardsCategoryInfo', $resultBoardCategoryInfo);
        });    
    }
}

// viewProvider 는 라라벨에 등록해야한다 > config/app.php
