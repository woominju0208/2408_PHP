<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyAuthExceptionFacede extends Facade {
    protected static function getFacadeAccessor(){
        return 'MyAuthException';
    }
}