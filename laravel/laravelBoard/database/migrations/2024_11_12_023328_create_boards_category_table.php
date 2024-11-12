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
        // up에서 boards_category로 바꾸면 down 도 똑같이 바꿔줘야 한다.
        Schema::create('boards_category', function (Blueprint $table) {
            $table->id('bc_id');
            $table->char('bc_type', 1)->unique();       // unique 속성 추가 : 중복되지 않는 값으로 생성
            $table->string('bc_name', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards_category');
    }
};
