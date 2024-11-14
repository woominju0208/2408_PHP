<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {   
        // 로그인이 안돼있을시 로그인페이지로 이동
        // board route에서 사용 
        if (! $request->expectsJson()) {
            return route('goLogin');
        }
    }
}
