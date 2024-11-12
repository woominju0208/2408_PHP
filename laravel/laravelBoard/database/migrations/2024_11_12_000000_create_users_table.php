<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 테이블을 스키마(구조화)를 하는것
        // 그래서 암호화처리는 여기가 아니라 데이터를 만들때 하는것
        Schema::create('users', function (Blueprint $table) {
            $table->id('u_id');                         // pk
            $table->string('u_email', 100)->unique();   // varchar
            $table->string('u_password', 255);          // varchar
            $table->string('u_name', 50);               // varchar
            $table->timestamps();               // created_at, updated_at 생성
            $table->softDeletes();              // deleted_at 생성

            // 필요하다면 하나하나 설정하면 됨
            // $table->timestamp('created_at')->default(DB::raw('current_timestamp'));
            // $table->timestamp('updated_at')->default(DB::raw('current_timestamp'));
            // $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
