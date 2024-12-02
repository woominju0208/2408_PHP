<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $th) {
           
        });
    }
    // 예외 및 에러났을때 호출
    public function report(Throwable $th) {
        Log::info("Report: ". $th->getMessage());
    }

    public function render($request, Throwable $th) {
        // 예외 코드 초기화
        $code = 'E99';
        
        // 인스턴스 확인후 예외정보 처리
        if($th instanceof AuthenticationException) {
            $code = 'E01';
        } else if($th instanceof PDOException) {
            $code = 'E80';
        }   

        $errorInfo = $this->context()[$code];

        // 커스텀 Exception인스턴스 확인
        if($th instanceof MyAuthException) {
            $code = $th->getMessage();
            $errorInfo = $th->context()[$code];
        };

        $responseData = [
            'success' => false
            ,'code' => $code
            ,'msg' => $errorInfo['msg']
        ];
        return response()->json($responseData, $errorInfo['status']);
    }


    public function context() {
        return [
            'E01' => ['status' => 401, 'msg' => '인증실패']
            ,'E80' => ['status' => 500, 'msg' => 'DB 에러 발생 '] 
            ,'E99' => ['status' => 500, 'msg' => '시스템 에러 발생']  
        ];
    }
}
